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
<<<<<<< Updated upstream
=======

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

        @if(optional(auth()->user())->hasRole('customer'))
            <div class="mt-6">
                <a href="{{ route('orders.create') }}"
                    class="block bg-blue-600 hover:bg-blue-700 text-white rounded-2xl p-5 text-center font-semibold shadow transition">

                    + Tambah Order

                </a>
            </div>
        @endif

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

>>>>>>> Stashed changes
    </div>

</div>

@endsection
