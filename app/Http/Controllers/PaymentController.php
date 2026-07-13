<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        /** @var User|null $user */
        $user = Auth::user();

        $query = Payment::with('order.user')->latest();

        if ($request->filled('kode_order')) {
            $query->whereHas('order', function ($query) use ($request) {
                $query->where('kode_order', 'like', '%' . $request->kode_order . '%');
            });
        }

        if ($request->filled('customer')) {
            $query->whereHas('order.user', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->customer . '%');
            });
        }

        if ($request->filled('metode')) {
            $query->where('metode', $request->metode);
        }

        if ($request->filled('status_pembayaran')) {
            $query->where('status_pembayaran', $request->status_pembayaran);
        }

        if ($user && $user->hasRole('customer')) {
            $query->whereHas('order', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        }

        $payments = $query->get();

        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $orders = Order::all();

        return view('payments.create', compact('orders'));
    }

    public function checkout(Order $order)
    {
        return view('payments.checkout', compact('order'));
    }

    public function processCheckout(Request $request, Order $order)
    {
        $validated = $request->validate([
            'metode' => 'required|in:Cash,QRIS',
        ]);

        $payment = Payment::create([
            'order_id' => $order->id,
            'metode' => $validated['metode'],
            'jumlah' => $order->total_harga,
            'status_pembayaran' => $validated['metode'] === 'Cash' ? 'Lunas' : 'Pending',
            'tanggal_bayar' => $validated['metode'] === 'Cash' ? now() : null,
        ]);

        if ($validated['metode'] === 'Cash') {
            return redirect()->route('orders.payment.success', $order);
        }

        return redirect()->route('orders.payment.qris', [$order, $payment]);
    }

    public function qris(Order $order, Payment $payment)
    {
        return view('payments.qris', compact('order', 'payment'));
    }

    public function confirmQris(Request $request, Order $order, Payment $payment)
    {
        $payment->update([
            'status_pembayaran' => 'Lunas',
            'tanggal_bayar' => now(),
        ]);

        return redirect()->route('orders.payment.success', $order);
    }

    public function success(Order $order)
    {
        return view('payments.success', compact('order'));
    }

    public function edit(Payment $payment)
    {
        /** @var User|null $user */
        $user = Auth::user();

        if ($user && $user->hasRole('admin')) {
            return redirect()->route('payments.index')->with('error', 'Admin tidak diperbolehkan mengedit pembayaran.');
        }

        $orders = Order::all();

        return view('payments.edit', compact('payment', 'orders'));
    }

    public function update(Request $request, Payment $payment)
    {
        /** @var User|null $user */
        $user = Auth::user();

        if ($user && $user->hasRole('admin')) {
            return redirect()->route('payments.index')->with('error', 'Admin tidak diperbolehkan mengedit pembayaran.');
        }

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
