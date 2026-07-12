@extends('layouts.admin')

@section('title', 'Tambah Order')

@section('content')
<div class="bg-white rounded-xl shadow p-6 max-w-2xl">
    <h2 class="text-xl font-bold mb-4">Tambah Order</h2>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

<<<<<<< Updated upstream
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block mb-1">Customer</label>
                <select name="user_id" class="w-full border rounded px-3 py-2">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block mb-1">Kode Order</label>
                <input type="text" name="kode_order" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block mb-1">Tanggal Order</label>
                <input type="date" name="tanggal_order" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block mb-1">Estimasi Selesai</label>
                <input type="date" name="estimasi_selesai" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block mb-1">Status</label>
                <select name="status" class="w-full border rounded px-3 py-2">
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
                <label class="block mb-1">Pickup Type</label>
                <select name="pickup_type" class="w-full border rounded px-3 py-2">
                    <option value="Antar">Antar</option>
                    <option value="Jemput">Jemput</option>
                </select>
            </div>
            <div>
                <label class="block mb-1">Total Harga</label>
                <input type="number" name="total_harga" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="md:col-span-2">
                <label class="block mb-1">Catatan</label>
                <textarea name="catatan" class="w-full border rounded px-3 py-2"></textarea>
            </div>
        </div>

        <div class="mt-6 flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            <a href="{{ route('orders.index') }}" class="bg-gray-300 px-4 py-2 rounded">Batal</a>
        </div>
=======
        @if(optional(auth()->user())->hasRole('customer'))
            <div class="grid grid-cols-1 gap-6">

                <div>

                    <label class="block font-semibold mb-2">

                        Pilih Layanan

                    </label>

                    <select
                        name="service_id"
                        class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        required>

                        <option value="">Pilih layanan</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                {{ $service->nama_layanan }} - Rp {{ number_format($service->harga_per_kg, 0, ',', '.') }}
                            </option>
                        @endforeach

                    </select>

                </div>

                <div>

                    <label class="block font-semibold mb-2">

                        Tanggal

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

                        Jenis Cucian

                    </label>

                    <div class="space-y-3">
                        <label class="flex items-center gap-3">
                            <input type="radio" name="jenis_cucian" value="Pakaian" {{ old('jenis_cucian') == 'Pakaian' ? 'checked' : '' }} required>
                            <span>Pakaian</span>
                        </label>
                        <label class="flex items-center gap-3">
                            <input type="radio" name="jenis_cucian" value="Selimut / Bed Cover" {{ old('jenis_cucian') == 'Selimut / Bed Cover' ? 'checked' : '' }}>
                            <span>Selimut / Bed Cover</span>
                        </label>
                        <label class="flex items-center gap-3">
                            <input type="radio" name="jenis_cucian" value="Kain / Lainya" {{ old('jenis_cucian') == 'Kain / Lainya' ? 'checked' : '' }}>
                            <span>Kain / Lainya</span>
                        </label>
                    </div>

                </div>

                <div>

                    <label class="block font-semibold mb-2">

                        Catatan (Opsional)

                    </label>

                    <textarea
                        name="catatan"
                        rows="4"
                        placeholder="Contoh: Jangan gunakan pewangi"
                        class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('catatan') }}</textarea>

                </div>

            </div>

            <div class="mt-8 flex gap-4">

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl shadow transition">

                    Lanjut

                </button>

                <a
                    href="{{ route('dashboard') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-xl shadow transition">

                    Batal

                </a>

            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>

                    <label class="block font-semibold mb-2">

                        Customer

                    </label>

                    <select
                        name="user_id"
                        class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                        @foreach($users as $user)

                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>

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

                        <option value="Menunggu" {{ old('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="Diproses" {{ old('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="Dicuci" {{ old('status') == 'Dicuci' ? 'selected' : '' }}>Dicuci</option>
                        <option value="Dikeringkan" {{ old('status') == 'Dikeringkan' ? 'selected' : '' }}>Dikeringkan</option>
                        <option value="Disetrika" {{ old('status') == 'Disetrika' ? 'selected' : '' }}>Disetrika</option>
                        <option value="Selesai" {{ old('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="Diambil" {{ old('status') == 'Diambil' ? 'selected' : '' }}>Diambil</option>

                    </select>

                </div>

                <div>

                    <label class="block font-semibold mb-2">

                        Pickup Type

                    </label>

                    <select
                        name="pickup_type"
                        class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                        <option value="Antar" {{ old('pickup_type') == 'Antar' ? 'selected' : '' }}>Antar</option>
                        <option value="Jemput" {{ old('pickup_type') == 'Jemput' ? 'selected' : '' }}>Jemput</option>

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
        @endif

>>>>>>> Stashed changes
    </form>
</div>
@endsection
