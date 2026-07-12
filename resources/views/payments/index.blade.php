@extends('layouts.admin')

@section('title','Pembayaran')

@section('content')

<div class="flex justify-between items-center mb-6">
<<<<<<< Updated upstream
    <h2 class="text-xl font-bold">Daftar Pembayaran</h2>
    <a href="{{ route('payments.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        + Tambah Pembayaran
    </a>
=======

    <div>
        <p class="text-gray-500 text-sm">
            Kelola seluruh data pembayaran CleanGo Laundry.
        </p>
    </div>

>>>>>>> Stashed changes
</div>

<form action="{{ route('payments.index') }}" method="GET" class="mb-6 bg-white rounded-2xl shadow-lg p-5">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <label class="block text-sm font-semibold mb-2">Kode Order</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode order"
                class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none" />
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">Status</label>
            <select name="status"
                class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option value="">Semua Status</option>
                @foreach(['Pending','Lunas','Gagal'] as $status)
                    <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>{{ $status }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">Tanggal</label>
            <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none" />
        </div>

        <div class="flex items-end gap-3">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl shadow">Filter</button>
            <a href="{{ route('payments.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-xl">Reset</a>
        </div>
    </div>
</form>

@if(session('success'))
<div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
    {{ session('success') }}
</div>
@endif

<<<<<<< Updated upstream
<div class="bg-white rounded-xl shadow p-6">
    @forelse($payments as $payment)
        <div class="border rounded-xl p-4 mb-4 flex justify-between items-center">
            <div>
                <h4 class="font-bold">{{ $payment->order->kode_order ?? '-' }}</h4>
                <p class="text-gray-600">{{ $payment->order->user->name ?? '-' }}</p>
                <p class="font-semibold mt-1">Rp {{ number_format($payment->jumlah,0,',','.') }}</p>
                <p class="text-sm text-gray-500">{{ $payment->metode }} • {{ $payment->tanggal_bayar ?? '-' }}</p>
            </div>
            <div class="text-right">
                @php
                    $paymentClass = match($payment->status_pembayaran) {
                        'Pending' => 'bg-yellow-100 text-yellow-700',
                        'Lunas' => 'bg-green-100 text-green-700',
                        'Gagal' => 'bg-red-100 text-red-700',
                        default => 'bg-gray-100 text-gray-700',
                    };
                @endphp
                <span class="px-3 py-1 rounded-full text-sm {{ $paymentClass }}">{{ $payment->status_pembayaran }}</span>
                <div class="mt-3">
                    <a href="{{ route('payments.edit', $payment->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</a>
                    <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus pembayaran ini?')" class="bg-red-600 text-white px-3 py-1 rounded ml-1">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-10 text-gray-500">Belum ada data pembayaran.</div>
    @endforelse
=======
<div class="bg-white rounded-2xl shadow-lg overflow-x-auto">

    <table class="w-full min-w-[1100px]">

        <thead class="bg-blue-600 text-white">

            <tr>

                <th class="px-6 py-4 text-left">Kode Order</th>

                <th class="px-6 py-4 text-left">Customer</th>

                <th class="px-6 py-4 text-center">Metode</th>

                <th class="px-6 py-4 text-right">Jumlah</th>

                <th class="px-6 py-4 text-center">Status</th>

                <th class="px-6 py-4 text-center">Tanggal Bayar</th>

                <th class="px-6 py-4 text-center">Aksi</th>

            </tr>

        </thead>

        <tbody>

            @forelse($payments as $payment)

            <tr class="border-b hover:bg-blue-50 transition">

                <td class="px-6 py-4 font-semibold">

                    {{ optional($payment->order)->kode_order ?? '-' }}

                </td>

                <td class="px-6 py-4">

                    {{ optional(optional($payment->order)->user)->name ?? '-' }}

                </td>

                <td class="px-6 py-4 text-center">

                    {{ $payment->metode }}

                </td>

                <td class="px-6 py-4 text-right font-semibold text-green-600">

                    Rp {{ number_format($payment->jumlah,0,',','.') }}

                </td>

                <td class="px-6 py-4 text-center">

                    @switch($payment->status_pembayaran)

                        @case('Pending')
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">
                                Pending
                            </span>
                        @break

                        @case('Lunas')
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                                Lunas
                            </span>
                        @break

                        @case('Gagal')
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">
                                Gagal
                            </span>
                        @break

                        @default
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                                {{ $payment->status_pembayaran }}
                            </span>

                    @endswitch

                </td>

                <td class="px-6 py-4 text-center">

                    {{ $payment->tanggal_bayar ? \Carbon\Carbon::parse($payment->tanggal_bayar)->format('d M Y') : '-' }}

                </td>

                <td class="px-6 py-4">

                    <div class="flex justify-center gap-2">

<form action="{{ route('payments.destroy',$payment) }}" method="POST">

                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('Yakin ingin menghapus pembayaran ini?')"
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm">

                                Hapus

                            </button>

                        </form>

                    </div>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="7" class="text-center py-10 text-gray-500">

                    Belum ada data pembayaran.

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

>>>>>>> Stashed changes
</div>

@endsection
