@extends('layouts.admin')

@section('title', 'Laporan')

@section('content')

{{-- ================= Statistik ================= --}}
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">

    <div class="bg-white rounded-2xl shadow p-6">
        <p class="text-gray-500">Total Customer</p>
        <h2 class="text-3xl font-bold text-blue-600 mt-2">
            {{ $totalUser }}
        </h2>
    </div>

    <div class="bg-white rounded-2xl shadow p-6">
        <p class="text-gray-500">Total Order</p>
        <h2 class="text-3xl font-bold text-green-600 mt-2">
            {{ $totalOrder }}
        </h2>
    </div>

    <div class="bg-white rounded-2xl shadow p-6">
        <p class="text-gray-500">Order Selesai</p>
        <h2 class="text-3xl font-bold text-yellow-500 mt-2">
            {{ $orderSelesai }}
        </h2>
    </div>

    <div class="bg-white rounded-2xl shadow p-6">
        <p class="text-gray-500">Total Pendapatan</p>
        <h2 class="text-3xl font-bold text-red-500 mt-2">
            Rp {{ number_format($totalPendapatan,0,',','.') }}
        </h2>
    </div>

</div>

{{-- ================= Filter ================= --}}
<div class="bg-white rounded-2xl shadow p-6 mb-6">

    <form method="GET" action="{{ route('reports.index') }}">

        <div class="grid grid-cols-1 md:grid-cols-6 gap-4">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari kode order / customer..."
                class="border rounded-lg px-4 py-2">

            <input
                type="date"
                name="tanggal_awal"
                value="{{ request('tanggal_awal') }}"
                class="border rounded-lg px-4 py-2">

            <input
                type="date"
                name="tanggal_akhir"
                value="{{ request('tanggal_akhir') }}"
                class="border rounded-lg px-4 py-2">

            <select
                name="status"
                class="border rounded-lg px-4 py-2">

                <option value="">Semua Status</option>

                @foreach($statusList as $status)

                    <option
                        value="{{ $status }}"
                        {{ request('status')==$status ? 'selected':'' }}>

                        {{ $status }}

                    </option>

                @endforeach

            </select>

            <select
                name="metode"
                class="border rounded-lg px-4 py-2">

                <option value="">Semua Metode</option>

                @foreach($metodeList as $metode)

                    <option
                        value="{{ $metode }}"
                        {{ request('metode')==$metode ? 'selected':'' }}>

                        {{ $metode }}

                    </option>

                @endforeach

            </select>

            <div class="flex gap-2">

                <button
                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">

                    Filter

                </button>

                <a
                    href="{{ route('reports.index') }}"
                    class="flex-1 bg-gray-500 hover:bg-gray-600 text-white rounded-lg flex items-center justify-center">

                    Reset

                </a>

            </div>

        </div>

    </form>

</div>

{{-- ================= Export ================= --}}
<div class="flex justify-end mb-5">

    <a
        href="{{ route('reports.pdf', request()->query()) }}"
        class="bg-red-600 hover:bg-red-700 text-white px-5 py-3 rounded-xl shadow">

        Export PDF

    </a>

</div>

{{-- ================= Table ================= --}}
<div class="bg-white rounded-2xl shadow overflow-hidden">

<table class="min-w-full">

<thead class="bg-blue-600 text-white">

<tr>

<th class="px-5 py-4 text-left">No</th>

<th class="px-5 py-4 text-left">Kode Order</th>

<th class="px-5 py-4 text-left">Customer</th>

<th class="px-5 py-4 text-left">Tanggal</th>

<th class="px-5 py-4 text-left">Status</th>

<th class="px-5 py-4 text-left">Metode</th>

<th class="px-5 py-4 text-right">Total</th>

</tr>

</thead>

<tbody>

@forelse($orders as $order)

<tr class="border-b hover:bg-gray-50">

<td class="px-5 py-4">

{{ $orders->firstItem()+$loop->index }}

</td>

<td class="px-5 py-4 font-semibold">

{{ $order->kode_order }}

</td>

<td class="px-5 py-4">

{{ $order->user->name }}

</td>

<td class="px-5 py-4">

{{ \Carbon\Carbon::parse($order->tanggal_order)->format('d-m-Y') }}

</td>

<td class="px-5 py-4">

{{ $order->status }}

</td>

<td class="px-5 py-4">

{{ optional($order->payment)->metode ?? '-' }}

</td>

<td class="px-5 py-4 text-right">

Rp {{ number_format($order->total_harga,0,',','.') }}

</td>

</tr>

@empty

<tr>

<td colspan="7" class="text-center py-8 text-gray-500">

Tidak ada data laporan.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

<div class="mt-6">

{{ $orders->links() }}

</div>

@endsection
