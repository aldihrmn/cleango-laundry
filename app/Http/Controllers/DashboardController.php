<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Service;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCustomer = Customer::count();
        $totalService = Service::count();

        // Nanti akan dipakai setelah fitur Order selesai
        $totalOrder = 0;
        $totalRevenue = 0;

        return view('dashboard', compact(
            'totalCustomer',
            'totalService',
            'totalOrder',
            'totalRevenue'
        ));
    }
}
