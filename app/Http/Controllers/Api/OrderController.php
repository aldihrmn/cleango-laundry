<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LaundryStatusLog;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the authenticated user's orders.
     */
    public function index(Request $request): JsonResponse
    {
        $orders = $request->user()->orders()
            ->with(['orderItems.service', 'statusLogs'])
            ->when($request->query('status'), function ($query, $status) {
                $query->where('status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $orders,
        ]);
    }

    /**
     * Display the specified order.
     */
    public function show(Request $request, $id): JsonResponse
    {
        $order = Order::find($id);

        if (! $order) {
            return response()->json([
                'success' => false,
                'message' => 'Order tidak ditemukan',
            ], 404);
        }

        if ($order->user_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses ke order ini',
            ], 403);
        }

        $order->load([
            'orderItems.service',
            'statusLogs' => fn ($query) => $query->orderBy('created_at', 'asc'),
        ]);

        return response()->json([
            'success' => true,
            'data' => $order,
        ]);
    }

    /**
     * Store a newly created order.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'items' => ['required', 'array', 'min:1'],
            'items.*.service_id' => ['required', 'integer', 'exists:services,id'],
            'items.*.berat' => ['required', 'numeric', 'min:0.01'],
            'pickup_type' => ['required', 'string', 'in:Antar,Jemput'],
            'catatan' => ['nullable', 'string'],
        ]);

        $services = Service::whereIn('id', collect($validated['items'])->pluck('service_id'))
            ->get()
            ->keyBy('id');

        $order = DB::transaction(function () use ($request, $validated, $services) {
            $tanggalOrder = now()->toDateString();
            $totalHarga = 0;
            $maxEstimasiHari = 0;

            foreach ($validated['items'] as $item) {
                $service = $services[$item['service_id']];
                $totalHarga += $service->harga_per_kg * $item['berat'];
                $maxEstimasiHari = max($maxEstimasiHari, $service->estimasi_hari);
            }

            $order = Order::create([
                'user_id' => $request->user()->id,
                'kode_order' => $this->generateKodeOrder(),
                'tanggal_order' => $tanggalOrder,
                'status' => 'Menunggu',
                'pickup_type' => $validated['pickup_type'],
                'estimasi_selesai' => now()->addDays($maxEstimasiHari)->toDateString(),
                'total_harga' => $totalHarga,
                'catatan' => $validated['catatan'] ?? null,
            ]);

            foreach ($validated['items'] as $item) {
                $service = $services[$item['service_id']];

                OrderItem::create([
                    'order_id' => $order->id,
                    'service_id' => $service->id,
                    'berat' => $item['berat'],
                    'harga' => $service->harga_per_kg,
                    'subtotal' => $service->harga_per_kg * $item['berat'],
                ]);
            }

            LaundryStatusLog::create([
                'order_id' => $order->id,
                'status' => 'Menunggu',
                'keterangan' => 'Order diterima',
            ]);

            return $order;
        });

        $order->load('orderItems.service');

        return response()->json([
            'success' => true,
            'data' => $order,
        ], 201);
    }

    /**
     * Update the status of the specified order.
     */
    public function updateStatus(Request $request, $id): JsonResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'in:Menunggu,Diproses,Dicuci,Dikeringkan,Disetrika,Selesai,Diambil'],
            'keterangan' => ['nullable', 'string'],
        ]);

        $order = Order::find($id);

        if (! $order) {
            return response()->json([
                'success' => false,
                'message' => 'Order tidak ditemukan',
            ], 404);
        }

        $keterangan = $validated['keterangan'] ?? "Status diperbarui ke {$validated['status']}";

        DB::transaction(function () use ($order, $validated, $keterangan) {
            $order->update(['status' => $validated['status']]);

            LaundryStatusLog::create([
                'order_id' => $order->id,
                'status' => $validated['status'],
                'keterangan' => $keterangan,
            ]);
        });

        $order->load([
            'orderItems.service',
            'statusLogs' => fn ($query) => $query->orderBy('created_at', 'asc'),
        ]);

        return response()->json([
            'success' => true,
            'data' => $order,
        ]);
    }

    /**
     * Record a payment for the specified order.
     */
    public function pay(Request $request, $id): JsonResponse
    {
        $validated = $request->validate([
            'metode' => ['required', 'string', 'in:Cash,Transfer,QRIS,E-Wallet'],
        ]);

        $order = Order::find($id);

        if (! $order) {
            return response()->json([
                'success' => false,
                'message' => 'Order tidak ditemukan',
            ], 404);
        }

        $payment = Payment::create([
            'order_id' => $order->id,
            'metode' => $validated['metode'],
            'jumlah' => $order->total_harga,
            'status_pembayaran' => 'Lunas',
            'tanggal_bayar' => now(),
        ]);

        return response()->json([
            'success' => true,
            'data' => $payment,
        ], 201);
    }

    /**
     * Generate a unique order code in the format ORD-{YYMMDD}-{4 digit random}.
     */
    private function generateKodeOrder(): string
    {
        do {
            $kodeOrder = 'ORD-'.now()->format('ymd').'-'.str_pad((string) random_int(0, 9999), 4, '0', STR_PAD_LEFT);
        } while (Order::where('kode_order', $kodeOrder)->exists());

        return $kodeOrder;
    }
}
