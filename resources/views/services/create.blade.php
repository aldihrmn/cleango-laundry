@extends('layouts.admin')

@section('title', 'Tambah Service')

@section('content')

<div class="flex justify-between items-center mb-6">

    <div>

        <h1 class="text-3xl font-bold text-gray-800">
            Tambah Service
        </h1>

        <p class="text-gray-500 mt-1">
            Tambahkan layanan baru untuk CleanGo Laundry.
        </p>

    </div>

    <a href="{{ route('services.index') }}"
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

    <form action="{{ route('services.store') }}" method="POST">

        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>

                <label class="block font-semibold mb-2">

                    Nama Layanan

                </label>

                <input
                    type="text"
                    name="nama_layanan"
                    value="{{ old('nama_layanan') }}"
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500"
                    required>

            </div>

            <div>

                <label class="block font-semibold mb-2">

                    Jenis Layanan

                </label>

                <input
                    type="text"
                    name="jenis_layanan"
                    value="{{ old('jenis_layanan') }}"
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500"
                    required>

            </div>

            <div>

                <label class="block font-semibold mb-2">

                    Harga per Kg

                </label>

                <input
                    type="number"
                    name="harga_per_kg"
                    value="{{ old('harga_per_kg') }}"
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500"
                    required>

            </div>

            <div>

                <label class="block font-semibold mb-2">

                    Estimasi Hari

                </label>

                <input
                    type="number"
                    name="estimasi_hari"
                    value="{{ old('estimasi_hari') }}"
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500"
                    required>

            </div>

        </div>

        <div class="mt-6">

            <label class="block font-semibold mb-2">

                Deskripsi

            </label>

            <textarea
                name="deskripsi"
                rows="4"
                class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500">{{ old('deskripsi') }}</textarea>

        </div>

        <div class="mt-6">

            <label class="block font-semibold mb-2">

                Status

            </label>

            <select
                name="is_active"
                class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500">

                <option value="1">Aktif</option>

                <option value="0">Tidak Aktif</option>

            </select>

        </div>

        <div class="mt-8 flex gap-4">

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl shadow transition">

                Simpan Service

            </button>

            <a
                href="{{ route('services.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-xl shadow transition">

                Batal

            </a>

        </div>

    </form>

</div>

@endsection
