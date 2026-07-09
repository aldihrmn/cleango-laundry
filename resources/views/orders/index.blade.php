@extends('layouts.admin')

@section('title','Data Order')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h2 class="text-xl font-bold">Daftar Order</h2>
    <a href="{{ route('orders.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        + Tambah Order
    </a>
</div>

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
