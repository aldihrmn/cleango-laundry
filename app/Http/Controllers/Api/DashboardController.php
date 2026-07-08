<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a summary of the authenticated user's orders.
     */
    public function index(Request $request): JsonResponse
    {
        $orders = $request->user()->orders();

        return response()->json([
            'success' => true,
            'data' => [
                'order_baru' => (clone $orders)->where('status', 'Menunggu')->count(),
                'proses' => (clone $orders)->whereIn('status', ['Diproses', 'Dicuci', 'Dikeringkan', 'Disetrika'])->count(),
                'selesai' => (clone $orders)->whereIn('status', ['Selesai', 'Diambil'])->count(),
                'total_pengeluaran' => (int) (clone $orders)->whereIn('status', ['Selesai', 'Diambil'])->sum('total_harga'),
            ],
        ]);
    }
}
