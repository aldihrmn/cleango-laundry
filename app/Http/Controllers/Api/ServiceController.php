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
        $services = Service::where('is_active', true)
            ->orderBy('harga_per_kg', 'asc')
            ->get(['id', 'nama_layanan', 'jenis_layanan', 'harga_per_kg', 'estimasi_hari', 'deskripsi']);

        return response()->json([
            'success' => true,
            'data' => $services,
        ]);
    }
}
