@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">
        Selamat Datang 👋
    </h1>

    <p class="text-gray-500">
        Sistem Manajemen CleanGo Laundry
    </p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

    <div class="bg-white shadow rounded-lg p-6 border-l-4 border-blue-500">
        <p class="text-gray-500">Total User</p>
        <h2 class="text-3xl font-bold">{{ $totalUser }}</h2>
    </div>

    <div class="bg-white shadow rounded-lg p-6 border-l-4 border-green-500">
        <p class="text-gray-500">Total Service</p>
        <h2 class="text-3xl font-bold">{{ $totalService }}</h2>
    </div>

    <div class="bg-white shadow rounded-lg p-6 border-l-4 border-yellow-500">
        <p class="text-gray-500">Total Order</p>
        <h2 class="text-3xl font-bold">{{ $totalOrder }}</h2>
    </div>

    <div class="bg-white shadow rounded-lg p-6 border-l-4 border-red-500">
        <p class="text-gray-500">Pendapatan</p>
        <h2 class="text-3xl font-bold">
            Rp {{ number_format($totalRevenue, 0, ',', '.') }}
        </h2>
    </div>

</div>

@endsection
