@extends('layouts.admin')

@section('title', 'Laporan')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    <div class="bg-white shadow rounded-lg p-6 border-l-4 border-blue-500">
        <p class="text-gray-500">Total User</p>
        <h2 class="text-3xl font-bold">{{ $totalUser }}</h2>
    </div>

    <div class="bg-white shadow rounded-lg p-6 border-l-4 border-green-500">
        <p class="text-gray-500">Total Order</p>
        <h2 class="text-3xl font-bold">{{ $totalOrder }}</h2>
    </div>

    <div class="bg-white shadow rounded-lg p-6 border-l-4 border-yellow-500">
        <p class="text-gray-500">Order Selesai</p>
        <h2 class="text-3xl font-bold">{{ $orderSelesai }}</h2>
    </div>

    <div class="bg-white shadow rounded-lg p-6 border-l-4 border-red-500">
        <p class="text-gray-500">Pendapatan</p>
        <h2 class="text-3xl font-bold">
            Rp {{ number_format($totalPendapatan,0,',','.') }}
        </h2>
    </div>

</div>

<!-- Filter -->
<div class="bg-white shadow rounded-lg p-5 mb-6">

    <form action="{{ route('reports.index') }}" method="GET">

        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">

            <div>
                <label class="block font-medium mb-2">
                    Tanggal Awal
                </label>

                <input
                    type="date"
                    name="tanggal_awal"
                    value="{{ request('tanggal_awal') }}"
                    class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block font-medium mb-2">
                    Tanggal Akhir
                </label>

                <input
                    type="date"
                    name="tanggal_akhir"
                    value="{{ request('tanggal_akhir') }}"
                    class="w-full border rounded p-2">
            </div>

            <div class="flex items-end">
                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded w-full">
                    Filter
                </button>
            </div>

            <div class="flex items-end">
                <a href="{{ route('reports.index') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded w-full text-center">
                    Reset
                </a>
            </div>

            <div class="flex items-end">
                <a href="{{ route('reports.pdf', request()->query()) }}"
                   class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded w-full text-center">
                    Export PDF
                </a>
            </div>

        </div>

    </form>

</div>

<!-- Tabel -->
<div class="bg-white shadow rounded-lg overflow-hidden">

    <div class="p-5 border-b">
        <h2 class="text-xl font-bold">
            Data Laporan Order
        </h2>
    </div>

    <table class="w-full">

        <thead class="bg-gray-100">

            <tr>
                <th class="border p-3">No</th>
                <th class="border p-3">Kode Order</th>
                <th class="border p-3">Customer</th>
                <th class="border p-3">Tanggal</th>
                <th class="border p-3">Status</th>
                <th class="border p-3">Pickup</th>
                <th class="border p-3">Total</th>
            </tr>

        </thead>

        <tbody>

        @forelse($orders as $order)

            <tr>

                <td class="border p-3 text-center">
                    {{ $loop->iteration }}
                </td>

                <td class="border p-3">
                    {{ $order->kode_order }}
                </td>

                <td class="border p-3">
                    {{ $order->user->name }}
                </td>

                <td class="border p-3">
                    {{ $order->tanggal_order }}
                </td>

                <td class="border p-3">
                    {{ $order->status }}
                </td>

                <td class="border p-3">
                    {{ $order->pickup_type }}
                </td>

                <td class="border p-3">
                    Rp {{ number_format($order->total_harga,0,',','.') }}
                </td>

            </tr>

        @empty

            <tr>

                <td colspan="7" class="text-center p-5">
                    Belum ada data order.
                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection
