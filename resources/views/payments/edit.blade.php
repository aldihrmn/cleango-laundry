@extends('layouts.admin')

@section('title', 'Edit Pembayaran')

@section('content')
<div class="bg-white rounded-xl shadow p-6 max-w-2xl">
    <h2 class="text-xl font-bold mb-4">Edit Pembayaran</h2>

    <form action="{{ route('payments.update', $payment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block mb-1">Order</label>
                <select name="order_id" class="w-full border rounded px-3 py-2">
                    @foreach($orders as $order)
                        <option value="{{ $order->id }}" {{ $order->id == $payment->order_id ? 'selected' : '' }}>{{ $order->kode_order }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block mb-1">Metode</label>
                <select name="metode" class="w-full border rounded px-3 py-2">
                    @foreach(['Cash','Transfer','QRIS','E-Wallet'] as $metode)
                        <option value="{{ $metode }}" {{ $payment->metode == $metode ? 'selected' : '' }}>{{ $metode }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block mb-1">Jumlah</label>
                <input type="number" name="jumlah" class="w-full border rounded px-3 py-2" value="{{ $payment->jumlah }}" required>
            </div>
            <div>
                <label class="block mb-1">Status Pembayaran</label>
                <select name="status_pembayaran" class="w-full border rounded px-3 py-2">
                    @foreach(['Pending','Lunas','Gagal'] as $status)
                        <option value="{{ $status }}" {{ $payment->status_pembayaran == $status ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-2">
                <label class="block mb-1">Tanggal Bayar</label>
                <input type="datetime-local" name="tanggal_bayar" class="w-full border rounded px-3 py-2" value="{{ $payment->tanggal_bayar ? date('Y-m-d\TH:i', strtotime($payment->tanggal_bayar)) : '' }}">
            </div>
        </div>

        <div class="mt-6 flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Perubahan</button>
            <a href="{{ route('payments.index') }}" class="bg-gray-300 px-4 py-2 rounded">Batal</a>
        </div>
    </form>
</div>
@endsection
