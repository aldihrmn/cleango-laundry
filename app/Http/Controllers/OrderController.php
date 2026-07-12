<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'payment']);

        if (optional(Auth::user())->hasRole('customer')) {
            $query->where('user_id', Auth::id());
        }

        if ($request->filled('search')) {
            $query->where('kode_order', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal_order', $request->tanggal);
        }

        $orders = $query->orderBy('tanggal_order', 'desc')->get();

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $user = Auth::user();

        if (! optional($user)->hasRole('customer')) {
            abort(403);
        }

        $services = Service::all();

        return view('orders.create', compact('services'));
    }

    public function store(Request $request)
    {
        /** @var User|null $user */
        $user = Auth::user();

        if (! optional($user)->hasRole('customer')) {
            abort(403);
        }

        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'tanggal_order' => 'required|date',
            'jenis_cucian' => 'required|in:Pakaian,Selimut / Bed Cover,Kain / Lainya',
            'catatan' => 'nullable|string',
        ]);

        $service = Service::find($validated['service_id']);
        $totalHarga = $service->harga_per_kg;

        $order = Order::create([
            'user_id' => Auth::id(),
            'kode_order' => uniqid('ORD-'),
            'tanggal_order' => $validated['tanggal_order'],
            'status' => 'Menunggu',
            'pickup_type' => 'Antar',
            'estimasi_selesai' => Carbon::parse($validated['tanggal_order'])->addDays(2)->format('Y-m-d'),
            'total_harga' => $totalHarga,
            'catatan' => trim('Jenis Cucian: ' . $validated['jenis_cucian'] . '. ' . ($validated['catatan'] ?? '')),
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'service_id' => $service->id,
            'qty' => 1,
            'berat' => null,
            'harga' => $service->harga_per_kg,
            'subtotal' => $totalHarga,
        ]);

        return redirect()->route('orders.index')->with('success', 'Order berhasil ditambahkan.');
    }

    public function edit(Order $order)
    {
        $users = User::all();

        return view('orders.edit', compact('order', 'users'));
    }

    public function update(Request $request, Order $order)
    {
        if (optional(Auth::user())->hasRole('admin')) {
            $validated = $request->validate([
                'status' => 'required|in:Menunggu,Diproses,Dicuci,Dikeringkan,Disetrika,Selesai,Diambil',
            ]);

            $order->update($validated);

            return redirect()->route('orders.index')->with('success', 'Status order berhasil diperbarui.');
        }

        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'tanggal_order' => 'required|date',
            'jenis_cucian' => 'required|in:Pakaian,Selimut / Bed Cover,Kain / Lainya',
            'pickup_type' => 'required|in:Antar,Jemput',
            'catatan' => 'nullable|string',
        ]);

        $service = Service::find($validated['service_id']);
        $order->update([
            'tanggal_order' => $validated['tanggal_order'],
            'pickup_type' => $validated['pickup_type'],
            'catatan' => $validated['catatan'] ?? $order->catatan,
        ]);

        return redirect()->route('orders.index')->with('success', 'Order berhasil diperbarui.');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order berhasil dihapus.');
    }
}
