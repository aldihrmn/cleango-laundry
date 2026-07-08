<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    /**
     * Display a listing of the customers.
     */
    public function index(): JsonResponse
    {
        $customers = Customer::orderBy('name', 'asc')
            ->get(['id', 'name', 'phone', 'email', 'address']);

        return response()->json([
            'success' => true,
            'data' => $customers,
        ]);
    }

    /**
     * Display the specified customer.
     */
    public function show($id): JsonResponse
    {
        $customer = Customer::find($id, ['id', 'name', 'phone', 'email', 'address']);

        if (! $customer) {
            return response()->json([
                'success' => false,
                'message' => 'Customer tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $customer,
        ]);
    }
}
