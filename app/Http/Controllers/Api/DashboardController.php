<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a summary of the authenticated user's orders.
     */
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        $customer = Customer::where('email', $user->email)->first();

        if (! $customer) {
            return response()->json([
                'success' => true,
                'data' => [
                    'order_baru' => 0,
                    'proses' => 0,
                    'selesai' => 0,
                    'total_pengeluaran' => 0,
                ],
            ]);
        }

        $orders = Order::where('customer_id', $customer->id);

        return response()->json([
            'success' => true,
            'data' => [
                'order_baru' => (clone $orders)->where('status', 'baru')->count(),
                'proses' => (clone $orders)->where('status', 'proses')->count(),
                'selesai' => (clone $orders)->where('status', 'selesai')->count(),
                'total_pengeluaran' => (int) (clone $orders)->where('status', 'selesai')->sum('total_price'),
            ],
        ]);
    }
}
