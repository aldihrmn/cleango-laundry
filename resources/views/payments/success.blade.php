@extends('layouts.admin')

@section('title', 'Order Berhasil')

@section('content')

<div class="max-w-3xl mx-auto">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Order Berhasil!</h1>
            <p class="text-gray-500 mt-1">Pembayaran untuk order <strong>{{ $order->kode_order }}</strong> berhasil.</p>
        </div>
        <a href="{{ route('orders.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl shadow">Kembali ke Order</a>
    </div>

    <div class="bg-white rounded-3xl shadow-lg p-8 text-center">
        <div class="mb-6 inline-flex items-center justify-center w-24 h-24 rounded-full bg-green-100 text-green-700 text-5xl">
            ✓
        </div>

        <div class="mb-6 text-left">
            <p class="text-lg font-semibold">Kode Order Anda</p>
            <p class="text-3xl font-bold text-blue-600 mb-4">{{ $order->kode_order }}</p>
            <p class="text-gray-600">Tanggal Order: {{ \Carbon\Carbon::parse($order->tanggal_order)->format('d M Y') }}</p>
            <p class="text-gray-600">Estimasi Selesai: {{ \Carbon\Carbon::parse($order->estimasi_selesai)->format('d M Y') }}</p>
        </div>

        <a href="{{ route('orders.index') }}" class="inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white rounded-xl px-8 py-4 text-lg font-semibold">
            Lihat Order Saya
        </a>
    </div>
</div>

@endsection
