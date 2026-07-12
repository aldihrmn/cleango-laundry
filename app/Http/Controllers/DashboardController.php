<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUser = User::count();
        $totalService = Service::count();
        $totalOrder = Order::count();
        $totalRevenue = Order::sum('total_harga');

        return view('dashboard', compact(
            'totalUser',
            'totalService',
            'totalOrder',
            'totalRevenue'
        ));
    }
}
