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
        /** @var User|null $user */
        $user = Auth::user();

        $query = Order::with('user')->latest();

        if (! $user || ! $user->hasRole('admin')) {
            $query->where('user_id', Auth::id());
        }

        if ($request->filled('kode_order')) {
            $query->where('kode_order', 'like', '%' . $request->kode_order . '%');
        }

        if ($request->filled('customer')) {
            $query->whereHas('user', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->customer . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('pickup_type')) {
            $query->where('pickup_type', $request->pickup_type);
        }

        $orders = $query->get();

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $services = Service::where('is_active', true)->get();

        return view('orders.create', compact('services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'qty' => 'required|integer|min:1',
            'berat' => 'nullable|numeric|min:0',
            'kode_order' => 'required|string|max:50|unique:orders',
            'tanggal_order' => 'required|date',
            'status' => 'required|in:Menunggu,Diproses,Dicuci,Dikeringkan,Disetrika,Selesai,Diambil',
            'pickup_type' => 'required|in:Antar,Jemput',
            'catatan' => 'nullable|string',
        ]);

        $service = Service::findOrFail($validated['service_id']);

        $berat = max($validated['berat'] ?? 1, 1);
        $qty = $validated['qty'];
        $totalHarga = $service->harga_per_kg * $berat * $qty;
        $estimasiSelesai = Carbon::parse($validated['tanggal_order'])->addDays($service->estimasi_hari)->format('Y-m-d');

        $order = Order::create([
            'user_id' => Auth::id(),
            'kode_order' => $validated['kode_order'],
            'tanggal_order' => $validated['tanggal_order'],
            'status' => $validated['status'],
            'pickup_type' => $validated['pickup_type'],
            'estimasi_selesai' => $estimasiSelesai,
            'catatan' => $validated['catatan'] ?? null,
            'total_harga' => $totalHarga,
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'service_id' => $service->id,
            'berat' => $validated['berat'] ?? null,
            'qty' => $qty,
            'harga' => $service->harga_per_kg,
            'subtotal' => $totalHarga,
        ]);

        return redirect()->route('orders.payment', $order);
    }

    public function edit(Order $order)
    {
        $users = User::all();

        return view('orders.edit', compact('order', 'users'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'kode_order' => 'required|string|max:50|unique:orders,kode_order,' . $order->id,
            'tanggal_order' => 'required|date',
            'status' => 'required|in:Menunggu,Diproses,Dicuci,Dikeringkan,Disetrika,Selesai,Diambil',
            'pickup_type' => 'required|in:Antar,Jemput',
            'estimasi_selesai' => 'required|date',
            'total_harga' => 'required|numeric',
            'catatan' => 'nullable|string',
        ]);

        $order->update($validated);

        return redirect()->route('orders.index')->with('success', 'Order berhasil diperbarui.');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order berhasil dihapus.');
    }
}
