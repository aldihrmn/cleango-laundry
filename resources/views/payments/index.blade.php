@extends('layouts.admin')

@section('title', 'Data Payment')

@section('content')

<div class="flex justify-between items-center mb-6">

    <div>
        <p class="text-gray-500 text-sm">
            Kelola seluruh data pembayaran CleanGo Laundry.
        </p>
    </div>

    <a href="{{ route('payments.create') }}"
        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl font-semibold shadow">

        + Tambah Payment

    </a>

</div>

@if(session('success'))

<div class="mb-5 rounded-xl bg-green-100 border border-green-300 text-green-700 px-5 py-3">

    {{ session('success') }}

</div>

@endif

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

                        <a href="{{ route('payments.edit',$payment) }}"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm">

                            Edit

                        </a>

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

</div>

@endsection
