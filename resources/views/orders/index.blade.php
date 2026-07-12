@extends('layouts.admin')

@section('title','Data Order')

@section('content')

<div class="flex justify-between items-center mb-6">
<<<<<<< Updated upstream
    <h2 class="text-xl font-bold">Daftar Order</h2>
    <a href="{{ route('orders.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        + Tambah Order
    </a>
=======

    <div>
        <p class="text-gray-500 text-sm">
            Kelola seluruh data order CleanGo Laundry.
        </p>
    </div>

    @if(optional(auth()->user())->hasRole('customer'))
        <a href="{{ route('orders.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl font-semibold shadow">

            + Tambah Order

        </a>
    @endif

>>>>>>> Stashed changes
</div>

<form action="{{ route('orders.index') }}" method="GET" class="mb-6 bg-white rounded-2xl shadow-lg p-5">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <label class="block text-sm font-semibold mb-2">Kode Order</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode order"
                class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none" />
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">Status</label>
            <select name="status"
                class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option value="">Semua Status</option>
                @foreach(['Menunggu','Diproses','Dicuci','Dikeringkan','Disetrika','Selesai','Diambil'] as $status)
                    <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>{{ $status }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">Tanggal</label>
            <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none" />
        </div>

        <div class="flex items-end gap-3">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl shadow">Filter</button>
            <a href="{{ route('orders.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-xl">Reset</a>
        </div>
    </div>
</form>

@if(session('success'))
<div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-xl shadow p-6">
    <table class="w-full">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">Kode</th>
                <th class="p-3 text-left">Customer</th>
                <th class="p-3 text-left">Tanggal</th>
                <th class="p-3 text-left">Total</th>
                <th class="p-3 text-left">Status</th>
                <th class="p-3 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
<<<<<<< Updated upstream
                <tr class="border-b">
                    <td class="p-3">{{ $order->kode_order }}</td>
                    <td class="p-3">{{ $order->user->name ?? '-' }}</td>
                    <td class="p-3">{{ $order->tanggal_order }}</td>
                    <td class="p-3">Rp {{ number_format($order->total_harga,0,',','.') }}</td>
                    <td class="p-3">
                        @php
                            $statusClass = match($order->status) {
                                'Menunggu' => 'bg-yellow-100 text-yellow-700',
                                'Diproses' => 'bg-blue-100 text-blue-700',
                                'Dicuci' => 'bg-purple-100 text-purple-700',
                                'Dikeringkan' => 'bg-indigo-100 text-indigo-700',
                                'Disetrika' => 'bg-orange-100 text-orange-700',
                                'Selesai' => 'bg-green-100 text-green-700',
                                'Diambil' => 'bg-emerald-100 text-emerald-700',
                                default => 'bg-gray-100 text-gray-700',
                            };
                        @endphp
                        <span class="px-3 py-1 rounded-full {{ $statusClass }}">{{ $order->status }}</span>
                    </td>
                    <td class="p-3">
                        <a href="{{ route('orders.edit', $order->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</a>
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="inline">
=======

            <tr class="border-b hover:bg-blue-50 transition">

                <td class="px-6 py-4 font-semibold whitespace-nowrap">

                    {{ $order->kode_order }}

                </td>

                <td class="px-6 py-4 whitespace-nowrap">

                    {{ optional($order->user)->name ?? '-' }}

                </td>

                <td class="px-6 py-4 whitespace-nowrap">

                    {{ \Carbon\Carbon::parse($order->tanggal_order)->format('d M Y') }}

                </td>

                <td class="px-6 py-4 text-center">

                    @switch($order->status)

                        @case('Menunggu')
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-semibold">Menunggu</span>
                        @break

                        @case('Diproses')
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">Diproses</span>
                        @break

                        @case('Dicuci')
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">Dicuci</span>
                        @break

                        @case('Dikeringkan')
                            <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-sm font-semibold">Dikeringkan</span>
                        @break

                        @case('Disetrika')
                            <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm font-semibold">Disetrika</span>
                        @break

                        @case('Selesai')
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">Selesai</span>
                        @break

                        @case('Diambil')
                            <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-sm font-semibold">Diambil</span>
                        @break

                        @default
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                                {{ $order->status }}
                            </span>

                    @endswitch

                </td>

                <td class="px-6 py-4 text-center whitespace-nowrap">

                    {{ $order->pickup_type }}

                </td>

                <td class="px-6 py-4 text-right font-bold whitespace-nowrap text-green-600">

                    Rp {{ number_format($order->total_harga,0,',','.') }}

                </td>

                <td class="px-6 py-4">

                    <div class="flex justify-center gap-2 items-center">

                        @if(optional(auth()->user())->hasRole('customer') && optional($order->user)->id === auth()->id() && ! optional($order->payment)->id)
                            <a href="{{ route('checkout.index', $order) }}"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                                Bayar
                            </a>
                        @endif

                        <a href="{{ route('orders.edit',$order) }}"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm">

                            Edit

                        </a>

                        <form action="{{ route('orders.destroy',$order) }}"
                            method="POST">

>>>>>>> Stashed changes
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Hapus order ini?')" class="bg-red-600 text-white px-3 py-1 rounded ml-1">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-5">Belum ada order.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
