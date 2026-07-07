<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    /**
     * Display a listing of the services.
     */
    public function index(): JsonResponse
    {
        $services = Service::orderBy('price', 'asc')
            ->get(['id', 'name', 'price', 'duration', 'description']);

        return response()->json([
            'success' => true,
            'data' => $services,
        ]);
    }
}
