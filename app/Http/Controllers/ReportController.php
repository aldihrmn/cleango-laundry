<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user');

        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('tanggal_order', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);
        }

        $orders = $query->latest()->get();

        $totalUser = User::count();

        $totalOrder = $orders->count();

        $orderSelesai = $orders->where('status', 'Selesai')->count();

        $totalPendapatan = Payment::where('status_pembayaran', 'Lunas')
            ->sum('jumlah');

        return view('reports.index', compact(
            'orders',
            'totalUser',
            'totalOrder',
            'orderSelesai',
            'totalPendapatan'
        ));
    }

    public function exportPdf(Request $request)
    {
        $query = Order::with('user');

        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('tanggal_order', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);
        }

        $orders = $query->latest()->get();

        $totalUser = User::count();

        $totalOrder = $orders->count();

        $orderSelesai = $orders->where('status', 'Selesai')->count();

        $totalPendapatan = Payment::where('status_pembayaran', 'Lunas')
            ->sum('jumlah');

        $pdf = Pdf::loadView('reports.pdf', compact(
            'orders',
            'totalUser',
            'totalOrder',
            'orderSelesai',
            'totalPendapatan'
        ));

        return $pdf->download('Laporan-CleanGo-Laundry.pdf');
    }
}
