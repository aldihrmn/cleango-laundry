@extends('layouts.admin')

@section('title', 'Pembayaran QRIS')

@section('content')

<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Pembayaran QRIS</h1>
        <p class="text-gray-500 mt-1">Scan QRIS berikut untuk melakukan pembayaran.</p>
    </div>
    <a href="{{ route('orders.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-3 rounded-xl shadow">Kembali</a>
</div>

<div class="bg-white rounded-2xl shadow-lg p-8 max-w-3xl mx-auto text-center">
    <p class="font-semibold text-gray-700 mb-4">Total yang harus dibayar:</p>
    <p class="text-3xl font-bold text-green-600 mb-8">Rp {{ number_format($order->total_harga,0,',','.') }}</p>

    <img src="{{ asset('images/qris-placeholder.png') }}" alt="QRIS" class="mx-auto rounded-xl shadow-lg mb-6 max-w-xs" />

    <p class="text-gray-600 mb-8">Silakan scan QRIS di atas untuk menyelesaikan pembayaran.</p>

    <form action="{{ route('checkout.confirm', $order) }}" method="POST">
        @csrf
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl shadow">Saya sudah bayar</button>
    </form>
</div>

@endsection
