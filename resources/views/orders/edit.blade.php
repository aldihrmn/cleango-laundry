@extends('layouts.admin')

@section('title', 'Edit Order')

@section('content')
<div class="bg-white rounded-xl shadow p-6 max-w-2xl">
    <h2 class="text-xl font-bold mb-4">Edit Order</h2>

    <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block mb-1">Customer</label>
                <select name="user_id" class="w-full border rounded px-3 py-2">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $user->id == $order->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block mb-1">Kode Order</label>
                <input type="text" name="kode_order" class="w-full border rounded px-3 py-2" value="{{ $order->kode_order }}" required>
            </div>
            <div>
                <label class="block mb-1">Tanggal Order</label>
                <input type="date" name="tanggal_order" class="w-full border rounded px-3 py-2" value="{{ $order->tanggal_order }}" required>
            </div>
            <div>
                <label class="block mb-1">Estimasi Selesai</label>
                <input type="date" name="estimasi_selesai" class="w-full border rounded px-3 py-2" value="{{ $order->estimasi_selesai }}" required>
            </div>
<<<<<<< Updated upstream
            <div>
                <label class="block mb-1">Status</label>
                <select name="status" class="w-full border rounded px-3 py-2">
                    @foreach(['Menunggu','Diproses','Dicuci','Dikeringkan','Disetrika','Selesai','Diambil'] as $status)
                        <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
            </div>
=======

            @if(optional(auth()->user())->hasRole('admin'))
                <div>

                    <label class="block font-semibold mb-2">
                        Status
                    </label>

                    <select
                        name="status"
                        class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                        @foreach(['Menunggu','Diproses','Dicuci','Dikeringkan','Disetrika','Selesai','Diambil'] as $status)

                            <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>

                                {{ $status }}

                            </option>

                        @endforeach

                    </select>

                </div>
            @else
                <div>
                    <label class="block font-semibold mb-2">Status</label>
                    <input
                        type="text"
                        value="{{ $order->status }}"
                        class="w-full border rounded-xl px-4 py-3 bg-gray-100 text-gray-700"
                        readonly>
                </div>
            @endif

>>>>>>> Stashed changes
            <div>
                <label class="block mb-1">Pickup Type</label>
                <select name="pickup_type" class="w-full border rounded px-3 py-2">
                    @foreach(['Antar','Jemput'] as $type)
                        <option value="{{ $type }}" {{ $order->pickup_type == $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
            </div>
<<<<<<< Updated upstream
            <div>
                <label class="block mb-1">Total Harga</label>
                <input type="number" name="total_harga" class="w-full border rounded px-3 py-2" value="{{ $order->total_harga }}" required>
            </div>
            <div class="md:col-span-2">
                <label class="block mb-1">Catatan</label>
                <textarea name="catatan" class="w-full border rounded px-3 py-2">{{ $order->catatan }}</textarea>
            </div>
=======

            @if(optional(auth()->user())->hasRole('admin'))
                <div class="md:col-span-2">

                    <label class="block font-semibold mb-2">
                        Total Harga
                    </label>

                    <input
                        type="number"
                        name="total_harga"
                        value="{{ old('total_harga', $order->total_harga) }}"
                        class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        required>

                </div>
            @else
                <div class="md:col-span-2">
                    <label class="block font-semibold mb-2">Total Harga</label>
                    <input
                        type="text"
                        value="Rp {{ number_format($order->total_harga, 0, ',', '.') }}"
                        class="w-full border rounded-xl px-4 py-3 bg-gray-100 text-gray-700"
                        readonly>
                </div>
            @endif

            <div class="md:col-span-2">

                <label class="block font-semibold mb-2">
                    Catatan
                </label>

                <textarea
                    name="catatan"
                    rows="4"
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('catatan', $order->catatan) }}</textarea>

            </div>

>>>>>>> Stashed changes
        </div>

        <div class="mt-6 flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Perubahan</button>
            <a href="{{ route('orders.index') }}" class="bg-gray-300 px-4 py-2 rounded">Batal</a>
        </div>
    </form>
</div>
@endsection
