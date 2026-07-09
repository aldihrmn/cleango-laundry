@extends('layouts.admin')

@section('title','Pembayaran')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h2 class="text-xl font-bold">Daftar Pembayaran</h2>
    <a href="{{ route('payments.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        + Tambah Pembayaran
    </a>
</div>

@if(session('success'))
<div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
    {{ session('success') }}
</div>
@endif

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
</div>

@endsection
