<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->get();

        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan'   => 'required|max:100',
            'jenis_layanan'  => 'required|max:100',
            'harga_per_kg'   => 'required|numeric',
            'estimasi_hari'  => 'required|integer',
            'deskripsi'      => 'nullable',
            'is_active'      => 'required|boolean',
        ]);

        Service::create($request->all());

        return redirect()->route('services.index')
            ->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'nama_layanan'   => 'required|max:100',
            'jenis_layanan'  => 'required|max:100',
            'harga_per_kg'   => 'required|numeric',
            'estimasi_hari'  => 'required|integer',
            'deskripsi'      => 'nullable',
            'is_active'      => 'required|boolean',
        ]);

        $service->update($request->all());

        return redirect()->route('services.index')
            ->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('services.index')
            ->with('success', 'Layanan berhasil dihapus.');
    }
}
