<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout(Order $order)
    {
        $user = Auth::user();

        if (! $user || $order->user_id !== $user->id) {
            abort(403);
        }

        return view('checkout.index', compact('order'));
    }

    public function pay(Request $request, Order $order)
    {
        $user = Auth::user();

        if (! $user || $order->user_id !== $user->id) {
            abort(403);
        }

        $validated = $request->validate([
            'metode' => 'required|in:Cash,QRIS',
        ]);

        if ($validated['metode'] === 'Cash') {
            Payment::create([
                'order_id' => $order->id,
                'metode' => 'Cash',
                'jumlah' => $order->total_harga,
                'status_pembayaran' => 'Lunas',
                'tanggal_bayar' => now(),
            ]);

            return redirect()->route('checkout.success', $order);
        }

        return redirect()->route('checkout.qris', $order->id);
    }

    public function qris(Order $order)
    {
        $user = Auth::user();

        if (! $user || $order->user_id !== $user->id) {
            abort(403);
        }

        return view('checkout.qris', compact('order'));
    }

    public function confirm(Order $order)
    {
        $user = Auth::user();

        if (! $user || $order->user_id !== $user->id) {
            abort(403);
        }

        if (! $order->payment) {
            Payment::create([
                'order_id' => $order->id,
                'metode' => 'QRIS',
                'jumlah' => $order->total_harga,
                'status_pembayaran' => 'Lunas',
                'tanggal_bayar' => now(),
            ]);
        }

        return redirect()->route('checkout.success', $order);
    }

    public function success(Order $order)
    {
        $user = Auth::user();

        if (! $user || $order->user_id !== $user->id) {
            abort(403);
        }

        return view('checkout.success', compact('order'));
    }
}
