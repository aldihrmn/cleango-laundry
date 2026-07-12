<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('order.user')->latest()->get();

        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $orders = Order::all();

        return view('payments.create', compact('orders'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'metode' => 'required|in:Cash,Transfer,QRIS,E-Wallet',
            'jumlah' => 'required|numeric',
            'status_pembayaran' => 'required|in:Pending,Lunas,Gagal',
            'tanggal_bayar' => 'nullable|date',
        ]);

        Payment::create($validated);

        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil ditambahkan.');
    }

    public function edit(Payment $payment)
    {
        $orders = Order::all();

        return view('payments.edit', compact('payment', 'orders'));
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'metode' => 'required|in:Cash,Transfer,QRIS,E-Wallet',
            'jumlah' => 'required|numeric',
            'status_pembayaran' => 'required|in:Pending,Lunas,Gagal',
            'tanggal_bayar' => 'nullable|date',
        ]);

        $payment->update($validated);

        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil diperbarui.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil dihapus.');
    }
}
