@extends('layouts.admin')

@section('title', 'Pembayaran Order')

@section('content')

<div class="max-w-3xl mx-auto">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Pembayaran Order</h1>
            <p class="text-gray-500 mt-1">Pilih metode pembayaran untuk order <strong>{{ $order->kode_order }}</strong>.</p>
        </div>
        <a href="{{ route('orders.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-3 rounded-xl shadow">Kembali</a>
    </div>

    <div class="bg-white rounded-3xl shadow-lg p-8">
        <form action="{{ route('orders.payment.process', $order) }}" method="POST">
            @csrf

            <div class="space-y-6">
                <div>
                    <label class="block font-semibold mb-2">Metode Pembayaran</label>
                    <select name="metode" required class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <option value="">Pilih Metode</option>
                        <option value="Cash">Tunai</option>
                        <option value="QRIS">QRIS</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold mb-2">Total Bayar</label>
                    <div class="rounded-xl border border-gray-200 bg-gray-50 p-4 text-2xl font-bold text-green-700">
                        Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                    </div>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white rounded-xl px-6 py-4 text-lg font-semibold">
                    Lanjut ke Pembayaran
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
