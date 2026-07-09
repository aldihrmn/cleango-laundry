@extends('layouts.admin')

@section('title', 'Tambah Order')

@section('content')
<div class="bg-white rounded-xl shadow p-6 max-w-2xl">
    <h2 class="text-xl font-bold mb-4">Tambah Order</h2>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

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
    </form>
</div>
@endsection
