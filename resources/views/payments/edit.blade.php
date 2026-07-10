@extends('layouts.admin')

@section('title', 'Edit Pembayaran')

@section('content')

<div class="flex justify-between items-center mb-6">

    <div>

        <h1 class="text-3xl font-bold text-gray-800">
            Edit Pembayaran
        </h1>

        <p class="text-gray-500 mt-1">
            Perbarui data pembayaran CleanGo Laundry.
        </p>

    </div>

    <a href="{{ route('payments.index') }}"
        class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-3 rounded-xl shadow">

        Kembali

    </a>

</div>

@if ($errors->any())

<div class="bg-red-100 border border-red-300 text-red-700 rounded-xl p-4 mb-6">

    <ul class="list-disc ml-5">

        @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<div class="bg-white rounded-2xl shadow-lg p-8">

    <form action="{{ route('payments.update', $payment->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>

                <label class="block font-semibold mb-2">
                    Order
                </label>

                <select
                    name="order_id"
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                    @foreach($orders as $order)

                        <option value="{{ $order->id }}" {{ $order->id == $payment->order_id ? 'selected' : '' }}>

                            {{ $order->kode_order }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div>

                <label class="block font-semibold mb-2">
                    Metode Pembayaran
                </label>

                <select
                    name="metode"
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                    @foreach(['Cash','Transfer','QRIS','E-Wallet'] as $metode)

                        <option value="{{ $metode }}" {{ $payment->metode == $metode ? 'selected' : '' }}>

                            {{ $metode }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div>

                <label class="block font-semibold mb-2">
                    Jumlah Pembayaran
                </label>

                <input
                    type="number"
                    name="jumlah"
                    value="{{ old('jumlah', $payment->jumlah) }}"
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    required>

            </div>

            <div>

                <label class="block font-semibold mb-2">
                    Status Pembayaran
                </label>

                <select
                    name="status_pembayaran"
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                    @foreach(['Pending','Lunas','Gagal'] as $status)

                        <option value="{{ $status }}" {{ $payment->status_pembayaran == $status ? 'selected' : '' }}>

                            {{ $status }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="md:col-span-2">

                <label class="block font-semibold mb-2">
                    Tanggal Bayar
                </label>

                <input
                    type="datetime-local"
                    name="tanggal_bayar"
                    value="{{ old('tanggal_bayar', $payment->tanggal_bayar ? date('Y-m-d\TH:i', strtotime($payment->tanggal_bayar)) : '') }}"
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">

            </div>

        </div>

        <div class="mt-8 flex gap-4">

            <button
                type="submit"
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-8 py-3 rounded-xl shadow transition">

                Update Pembayaran

            </button>

            <a
                href="{{ route('payments.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-xl shadow transition">

                Batal

            </a>

        </div>

    </form>

</div>

@endsection
