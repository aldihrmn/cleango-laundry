@extends('layouts.admin')

@section('title', 'Pembayaran Order')

@section('content')

<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Pembayaran Order</h1>
        <p class="text-gray-500 mt-1">Konfirmasi pembayaran untuk order {{ $order->kode_order }}.</p>
    </div>
    <a href="{{ route('orders.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-3 rounded-xl shadow">Kembali</a>
</div>

<div class="bg-white rounded-2xl shadow-lg p-8 max-w-3xl mx-auto">
    <div class="grid gap-6">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="font-semibold text-gray-700">Kode Order</p>
                <p class="mt-2 text-gray-900">{{ $order->kode_order }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">Total Pembayaran</p>
                <p class="mt-2 text-green-600 font-bold">Rp {{ number_format($order->total_harga,0,',','.') }}</p>
            </div>
        </div>

        <form action="{{ route('checkout.pay', $order) }}" method="POST">
            @csrf

            <div>
                <label class="block font-semibold mb-2">Metode Pembayaran</label>
                <select name="metode" class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="Cash">Tunai</option>
                    <option value="QRIS">QRIS</option>
                </select>
            </div>

            <div class="mt-6 flex gap-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl shadow">Bayar Sekarang</button>
                <a href="{{ route('orders.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-xl shadow">Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection
