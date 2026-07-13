@extends('layouts.admin')

@section('title', 'Pembayaran QRIS')

@section('content')

<div class="max-w-3xl mx-auto">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Pembayaran QRIS</h1>
            <p class="text-gray-500 mt-1">Scan QRIS untuk menyelesaikan pembayaran order <strong>{{ $order->kode_order }}</strong>.</p>
        </div>
        <a href="{{ route('orders.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-3 rounded-xl shadow">Kembali</a>
    </div>

    <div class="bg-white rounded-3xl shadow-lg p-8 text-center">
        <div class="mb-6">
            <div class="inline-block rounded-3xl border border-gray-200 p-6 bg-gray-50">
                <img src="{{ asset('images/qris.png') }}"
                    alt="QRIS"
                    class="mx-auto rounded-3xl"
                    onerror="this.onerror=null;this.src='https://via.placeholder.com/320x320.png?text=QRIS+Code';" />
            </div>
        </div>

        <div class="text-left mb-6">
            <p class="text-gray-600">Order: <strong>{{ $order->kode_order }}</strong></p>
            <p class="text-gray-600">Total Bayar: <strong>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</strong></p>
            <p class="text-gray-600">Status Pembayaran: <strong>{{ $payment->status_pembayaran }}</strong></p>
        </div>

        <form action="{{ route('orders.payment.qris.confirm', [$order, $payment]) }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white rounded-xl px-6 py-4 text-lg font-semibold">
                Bayar Sekarang (Simulasi)
            </button>
        </form>
    </div>
</div>

@endsection
