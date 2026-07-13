@extends('layouts.admin')

@section('title', 'Data Order')

@section('content')

<div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between mb-6">

    <div>
        <p class="text-gray-500 text-sm">
            Kelola seluruh data order CleanGo Laundry.
        </p>
    </div>

    @if(auth()->user()->hasRole('customer'))
        <a href="{{ route('orders.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl font-semibold shadow">
            + Tambah Order
        </a>
    @endif

    <form action="{{ route('orders.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-3 w-full lg:w-auto">
        <input type="text" name="kode_order" value="{{ request('kode_order') }}" placeholder="Cari kode order"
            class="border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none w-full">

        <input type="text" name="customer" value="{{ request('customer') }}" placeholder="Cari customer"
            class="border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none w-full">

        <select name="status" class="border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none w-full">
            <option value="">Semua Status</option>
            @foreach(['Menunggu','Diproses','Dicuci','Dikeringkan','Disetrika','Selesai','Diambil'] as $status)
                <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>{{ $status }}</option>
            @endforeach
        </select>

        <select name="pickup_type" class="border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none w-full">
            <option value="">Semua Pickup</option>
            <option value="Antar" {{ request('pickup_type') == 'Antar' ? 'selected' : '' }}>Antar</option>
            <option value="Jemput" {{ request('pickup_type') == 'Jemput' ? 'selected' : '' }}>Jemput</option>
        </select>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl font-semibold shadow">
            Filter
        </button>
    </form>

</div>

@if(session('success'))

<div class="mb-5 rounded-xl bg-green-100 border border-green-300 text-green-700 px-5 py-3">

    {{ session('success') }}

</div>

@endif

<div class="bg-white rounded-2xl shadow-lg overflow-x-auto">

    <table class="w-full min-w-[1200px]">

        <thead class="bg-blue-600 text-white">

            <tr>

                <th class="px-6 py-4 text-left whitespace-nowrap">
                    Kode Order
                </th>

                <th class="px-6 py-4 text-left whitespace-nowrap">
                    Customer
                </th>

                <th class="px-6 py-4 text-left whitespace-nowrap">
                    Tanggal
                </th>

                <th class="px-6 py-4 text-center whitespace-nowrap">
                    Status
                </th>

                <th class="px-6 py-4 text-center whitespace-nowrap">
                    Pickup
                </th>

                <th class="px-6 py-4 text-right whitespace-nowrap">
                    Total
                </th>

                <th class="px-6 py-4 text-center whitespace-nowrap">
                    Aksi
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($orders as $order)

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
                    @if(auth()->user()->hasRole('admin'))
                        <div class="flex justify-center gap-2">

                            <a href="{{ route('orders.edit',$order) }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm">

                                Edit

                            </a>

                            <form action="{{ route('orders.destroy',$order) }}"
                                method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Yakin ingin menghapus order ini?')"
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm">

                                    Hapus

                                </button>

                            </form>

                        </div>
                    @endif
                </td>

            </tr>

            @empty

            <tr>

                <td colspan="7" class="text-center py-10 text-gray-500">

                    Belum ada data order.

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection
