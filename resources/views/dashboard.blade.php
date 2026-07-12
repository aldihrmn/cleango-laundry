@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<!-- Header -->
<div class="bg-gradient-to-r from-blue-600 to-cyan-500 rounded-3xl shadow-lg p-8 mb-8">

    <div class="flex items-center justify-between">

        <div>

            <p class="text-blue-100 text-lg">
                Selamat Datang 👋
            </p>

            <h1 class="text-4xl font-bold text-white mt-2">
                {{ Auth::user()->name }}
            </h1>

            <p class="text-blue-100 mt-3">
                Kelola seluruh aktivitas CleanGo Laundry dengan mudah.
            </p>

        </div>

        <div class="bg-white rounded-full p-3 shadow-lg">

            <img
                src="{{ asset('images/Logo.jpg') }}"
                alt="Logo"
                class="w-24 h-24 rounded-full">

        </div>

    </div>

</div>

<!-- Statistik -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

    <!-- Customer -->
    <div class="bg-white rounded-3xl p-6 shadow-lg hover:shadow-xl transition">

        <div class="flex justify-between items-center">

            <div>

                <p class="text-gray-500">
                    Total Customer
                </p>

                <h2 class="text-5xl font-bold text-blue-600 mt-2">
                    {{ $totalUser }}
                </h2>

            </div>

            <div class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center text-3xl">

                👤

            </div>

        </div>

    </div>

    <!-- Service -->
    <div class="bg-white rounded-3xl p-6 shadow-lg hover:shadow-xl transition">

        <div class="flex justify-between items-center">

            <div>

                <p class="text-gray-500">
                    Total Service
                </p>

                <h2 class="text-5xl font-bold text-green-600 mt-2">
                    {{ $totalService }}
                </h2>

            </div>

            <div class="w-16 h-16 rounded-2xl bg-green-100 flex items-center justify-center text-3xl">

                🧺

            </div>

        </div>

    </div>

    <!-- Order -->
    <div class="bg-white rounded-3xl p-6 shadow-lg hover:shadow-xl transition">

        <div class="flex justify-between items-center">

            <div>

                <p class="text-gray-500">
                    Total Order
                </p>

                <h2 class="text-5xl font-bold text-yellow-500 mt-2">
                    {{ $totalOrder }}
                </h2>

            </div>

            <div class="w-16 h-16 rounded-2xl bg-yellow-100 flex items-center justify-center text-3xl">

                📦

            </div>

        </div>

    </div>

    <!-- Revenue -->
    <div class="bg-white rounded-3xl p-6 shadow-lg hover:shadow-xl transition">

        <div class="flex justify-between items-center">

            <div>

                <p class="text-gray-500">
                    Pendapatan
                </p>

                <h2 class="text-2xl font-bold text-red-500 mt-2">

                    Rp {{ number_format($totalRevenue,0,',','.') }}

                </h2>

            </div>

            <div class="w-16 h-16 rounded-2xl bg-red-100 flex items-center justify-center text-3xl">

                💰

            </div>

        </div>

    </div>

</div>

<!-- Dashboard Bawah -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <!-- Menu Cepat -->
    <div class="bg-white rounded-3xl shadow-lg p-6">

        <h2 class="text-2xl font-bold text-gray-800 mb-6">

            Menu Cepat

        </h2>

        <div class="grid grid-cols-2 gap-4">

            <a href="{{ route('services.index') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white rounded-2xl p-5 text-center transition">

                <div class="text-4xl mb-2">🧺</div>

                Service

            </a>

            <a href="{{ route('orders.index') }}"
                class="bg-green-600 hover:bg-green-700 text-white rounded-2xl p-5 text-center transition">

                <div class="text-4xl mb-2">📦</div>

                Order

            </a>

            <a href="{{ route('payments.index') }}"
                class="bg-yellow-500 hover:bg-yellow-600 text-white rounded-2xl p-5 text-center transition">

                <div class="text-4xl mb-2">💳</div>

                Payment

            </a>

            <a href="{{ route('reports.index') }}"
                class="bg-red-500 hover:bg-red-600 text-white rounded-2xl p-5 text-center transition">

                <div class="text-4xl mb-2">📄</div>

                Report

            </a>

        </div>

    </div>

    <!-- Informasi -->
    <div class="bg-white rounded-3xl shadow-lg p-6">

        <h2 class="text-2xl font-bold text-gray-800 mb-6">

            Informasi

        </h2>

        <div class="space-y-4">

            <div class="bg-blue-50 border-l-4 border-blue-600 rounded-xl p-4">

                <h3 class="font-bold text-blue-700">

                    CleanGo Laundry

                </h3>

                <p class="text-gray-600 mt-1">

                    Sistem manajemen laundry yang membantu mengelola pelanggan, layanan, order, pembayaran, dan laporan.

                </p>

            </div>

            <div class="bg-green-50 border-l-4 border-green-600 rounded-xl p-4">

                <h3 class="font-bold text-green-700">

                    Dashboard Admin

                </h3>

                <p class="text-gray-600 mt-1">

                    Pantau seluruh aktivitas laundry secara real-time melalui dashboard ini.

                </p>

            </div>

            <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded-xl p-4">

                <h3 class="font-bold text-yellow-600">

                    Tips

                </h3>

                <p class="text-gray-600 mt-1">

                    Gunakan menu di sebelah kiri untuk mengelola Customer, Service, Order, Payment, dan Report.

                </p>

            </div>

        </div>

    </div>

</div>

@endsection
