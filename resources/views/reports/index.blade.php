@extends('layouts.admin')

@section('title', 'Laporan')

@section('content')

<div class="flex justify-between items-center mb-6">

    <div>

        <p class="text-gray-500 text-sm">
            Laporan keseluruhan CleanGo Laundry.
        </p>

    </div>

</div>

{{-- Filter --}}

<div class="bg-white rounded-2xl shadow-lg p-6 mb-6">

    <form action="{{ route('reports.index') }}" method="GET">

        <div class="grid md:grid-cols-4 gap-4 items-end">

            <div>

                <label class="block text-sm font-semibold mb-2">
                    Tanggal Awal
                </label>

                <input
                    type="date"
                    name="tanggal_awal"
                    value="{{ request('tanggal_awal') }}"
                    class="w-full border rounded-xl px-4 py-3">

            </div>

            <div>

                <label class="block text-sm font-semibold mb-2">
                    Tanggal Akhir
                </label>

                <input
                    type="date"
                    name="tanggal_akhir"
                    value="{{ request('tanggal_akhir') }}"
                    class="w-full border rounded-xl px-4 py-3">

            </div>

            <div>

                <button
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl">

                    Filter

                </button>

            </div>

            <div>

                <a
                    href="{{ route('reports.pdf', request()->query()) }}"
                    class="block text-center bg-red-600 hover:bg-red-700 text-white py-3 rounded-xl">

                    Download PDF

                </a>

            </div>

        </div>

    </form>

</div>

{{-- Statistik --}}

<div class="grid md:grid-cols-4 gap-6 mb-6">

    <div class="bg-white rounded-2xl shadow p-6">

        <p class="text-gray-500">
            Total Customer
        </p>

        <h2 class="text-4xl font-bold text-blue-600 mt-2">

            {{ $totalUser }}

        </h2>

    </div>

    <div class="bg-white rounded-2xl shadow p-6">

        <p class="text-gray-500">
            Total Order
        </p>

        <h2 class="text-4xl font-bold text-green-600 mt-2">

            {{ $totalOrder }}

        </h2>

    </div>

    <div class="bg-white rounded-2xl shadow p-6">

        <p class="text-gray-500">
            Order Selesai
        </p>

        <h2 class="text-4xl font-bold text-yellow-500 mt-2">

            {{ $orderSelesai }}

        </h2>

    </div>

    <div class="bg-white rounded-2xl shadow p-6">

        <p class="text-gray-500">
            Pendapatan
        </p>

        <h2 class="text-2xl font-bold text-red-600 mt-2">

            Rp {{ number_format($totalPendapatan,0,',','.') }}

        </h2>

    </div>

</div>

{{-- Tabel --}}

<div class="bg-white rounded-2xl shadow-lg overflow-x-auto">

    <table class="w-full">

        <thead class="bg-blue-600 text-white">

            <tr>

                <th class="px-5 py-4 text-left">
                    Kode
                </th>

                <th class="px-5 py-4 text-left">
                    Customer
                </th>

                <th class="px-5 py-4 text-center">
                    Tanggal
                </th>

                <th class="px-5 py-4 text-center">
                    Status
                </th>

                <th class="px-5 py-4 text-right">
                    Total
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($orders as $order)

            <tr class="border-b hover:bg-blue-50">

                <td class="px-5 py-4 font-semibold">

                    {{ $order->kode_order }}

                </td>

                <td class="px-5 py-4">

                    {{ $order->user->name }}

                </td>

                <td class="px-5 py-4 text-center">

                    {{ \Carbon\Carbon::parse($order->tanggal_order)->format('d M Y') }}

                </td>

                <td class="px-5 py-4 text-center">

                    @if($order->status=='Selesai')

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">

                            {{ $order->status }}

                        </span>

                    @elseif($order->status=='Diproses')

                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full">

                            {{ $order->status }}

                        </span>

                    @else

                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">

                            {{ $order->status }}

                        </span>

                    @endif

                </td>

                <td class="px-5 py-4 text-right font-semibold">

                    Rp {{ number_format($order->total_harga,0,',','.') }}

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="5" class="text-center py-8 text-gray-500">

                    Tidak ada data.

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection
