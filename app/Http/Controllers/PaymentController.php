<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with('order.user');

        if ($request->filled('search')) {
            $query->whereHas('order', function ($orderQuery) use ($request) {
                $orderQuery->where('kode_order', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status_pembayaran', $request->status);
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal_bayar', $request->tanggal);
        }

        $payments = $query->orderBy('tanggal_bayar', 'desc')->get();

        return view('payments.index', compact('payments'));
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil dihapus.');
    }
}
