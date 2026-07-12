@extends('layouts.admin')

@section('title', 'Order Berhasil')

@section('content')

<div class="flex justify-center items-center min-h-[70vh]">
    <div class="bg-white rounded-3xl shadow-2xl p-10 text-center max-w-lg w-full">
        <div class="mx-auto h-24 w-24 rounded-full bg-green-100 flex items-center justify-center mb-8">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 00-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z" clip-rule="evenodd" />
            </svg>
        </div>
        <h1 class="text-3xl font-bold mb-4 text-gray-800">Order Berhasil!</h1>
        <p class="text-gray-600 mb-2">Kode Order Anda: <span class="font-semibold">{{ $order->kode_order }}</span></p>
        <p class="text-gray-600 mb-6">Pembayaran telah dikonfirmasi.</p>
        <a href="{{ route('orders.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl shadow">Lihat Order Saya</a>
    </div>
</div>

@endsection
