@extends('layouts.admin')

@section('title', 'Tambah Order')

@section('content')

<div class="flex justify-between items-center mb-6">

    <div>

        <h1 class="text-3xl font-bold text-gray-800">
            Tambah Order
        </h1>

        <p class="text-gray-500 mt-1">
            Tambahkan data order baru CleanGo Laundry.
        </p>

    </div>

    <a href="{{ route('orders.index') }}"
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

    <form action="{{ route('orders.store') }}" method="POST">

        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>

                <label class="block font-semibold mb-2">

                    Customer

                </label>

                <select
                    name="user_id"
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                    @foreach($users as $user)

                        <option value="{{ $user->id }}">

                            {{ $user->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div>

                <label class="block font-semibold mb-2">

                    Kode Order

                </label>

                <input
                    type="text"
                    name="kode_order"
                    value="{{ old('kode_order') }}"
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    required>

            </div>

            <div>

                <label class="block font-semibold mb-2">

                    Tanggal Order

                </label>

                <input
                    type="date"
                    name="tanggal_order"
                    value="{{ old('tanggal_order') }}"
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    required>

            </div>

            <div>

                <label class="block font-semibold mb-2">

                    Estimasi Selesai

                </label>

                <input
                    type="date"
                    name="estimasi_selesai"
                    value="{{ old('estimasi_selesai') }}"
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    required>

            </div>

            <div>

                <label class="block font-semibold mb-2">

                    Status

                </label>

                <select
                    name="status"
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                    <option value="Menunggu">Menunggu</option>
                    <option value="Diproses">Diproses</option>
                    <option value="Dicuci">Dicuci</option>
                    <option value="Dikeringkan">Dikeringkan</option>
                    <option value="Disetrika">Disetrika</option>
                    <option value="Selesai">Selesai</option>
                    <option value="Diambil">Diambil</option>

                </select>

            </div>

            <div>

                <label class="block font-semibold mb-2">

                    Pickup Type

                </label>

                <select
                    name="pickup_type"
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                    <option value="Antar">Antar</option>

                    <option value="Jemput">Jemput</option>

                </select>

            </div>

            <div class="md:col-span-2">

                <label class="block font-semibold mb-2">

                    Total Harga

                </label>

                <input
                    type="number"
                    name="total_harga"
                    value="{{ old('total_harga') }}"
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    required>

            </div>

            <div class="md:col-span-2">

                <label class="block font-semibold mb-2">

                    Catatan

                </label>

                <textarea
                    name="catatan"
                    rows="4"
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('catatan') }}</textarea>

            </div>

        </div>

        <div class="mt-8 flex gap-4">

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl shadow transition">

                Simpan Order

            </button>

            <a
                href="{{ route('orders.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-xl shadow transition">

                Batal

            </a>

        </div>

    </form>

</div>

@endsection
