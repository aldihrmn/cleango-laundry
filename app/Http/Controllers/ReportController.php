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
        $query = Order::with(['user', 'payment']);

        // ==========================
        // SEARCH
        // ==========================
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('kode_order', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($user) use ($search) {

                        $user->where('name', 'like', "%{$search}%");
                    });

            });

        }

        // ==========================
        // FILTER TANGGAL
        // ==========================

        if ($request->filled('tanggal_awal')) {

            $query->whereDate('tanggal_order', '>=', $request->tanggal_awal);

        }

        if ($request->filled('tanggal_akhir')) {

            $query->whereDate('tanggal_order', '<=', $request->tanggal_akhir);

        }

        // ==========================
        // FILTER STATUS ORDER
        // ==========================

        if ($request->filled('status')) {

            $query->where('status', $request->status);

        }

        // ==========================
        // FILTER METODE PEMBAYARAN
        // ==========================

        if ($request->filled('metode')) {

            $query->whereHas('payment', function ($payment) use ($request) {

                $payment->where('metode', $request->metode);

            });

        }

        // ==========================
        // DATA LAPORAN
        // ==========================

        $orders = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // ==========================
        // DROPDOWN
        // ==========================

        $statusList = Order::select('status')
            ->distinct()
            ->pluck('status');

        $metodeList = Payment::select('metode')
            ->distinct()
            ->pluck('metode');

        // ==========================
        // STATISTIK
        // ==========================

        $totalUser = User::count();

        $totalOrder = Order::count();

        $orderSelesai = Order::where('status', 'Selesai')->count();

        $totalPendapatan = Payment::where('status_pembayaran', 'Lunas')
            ->sum('jumlah');

        return view('reports.index', compact(
            'orders',
            'statusList',
            'metodeList',
            'totalUser',
            'totalOrder',
            'orderSelesai',
            'totalPendapatan'
        ));
    }

    public function exportPdf(Request $request)
    {
        $query = Order::with(['user', 'payment']);

        // SEARCH
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('kode_order', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($user) use ($search) {

                        $user->where('name', 'like', "%{$search}%");

                    });

            });

        }

        // FILTER TANGGAL

        if ($request->filled('tanggal_awal')) {

            $query->whereDate('tanggal_order', '>=', $request->tanggal_awal);

        }

        if ($request->filled('tanggal_akhir')) {

            $query->whereDate('tanggal_order', '<=', $request->tanggal_akhir);

        }

        // FILTER STATUS

        if ($request->filled('status')) {

            $query->where('status', $request->status);

        }

        // FILTER METODE

        if ($request->filled('metode')) {

            $query->whereHas('payment', function ($payment) use ($request) {

                $payment->where('metode', $request->metode);

            });

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
