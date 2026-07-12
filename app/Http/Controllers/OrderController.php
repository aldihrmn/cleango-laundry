<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->get();

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $users = User::all();

        return view('orders.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'kode_order' => 'required|string|max:50|unique:orders',
            'tanggal_order' => 'required|date',
            'status' => 'required|in:Menunggu,Diproses,Dicuci,Dikeringkan,Disetrika,Selesai,Diambil',
            'pickup_type' => 'required|in:Antar,Jemput',
            'estimasi_selesai' => 'required|date',
            'total_harga' => 'required|numeric',
            'catatan' => 'nullable|string',
        ]);

        Order::create($validated);

        return redirect()->route('orders.index')->with('success', 'Order berhasil ditambahkan.');
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
