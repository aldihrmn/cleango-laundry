@extends('layouts.admin')

@section('title','Pembayaran')

@section('content')

<div class="bg-white rounded-xl shadow p-6">

    <h2 class="text-2xl font-bold mb-5">
        Pembayaran
    </h2>

    <div class="flex border-b mb-5">

        <button class="px-5 py-2 border-b-2 border-blue-600 text-blue-600 font-semibold">
            Belum Lunas
        </button>

        <button class="px-5 py-2 text-gray-500">
            Lunas
        </button>

    </div>

    @forelse($payments as $payment)

        <div class="border rounded-xl p-4 mb-4 flex justify-between items-center">

            <div>

                <h4 class="font-bold">
                    {{ $payment->order->kode_order }}
                </h4>

                <p class="text-gray-600">
                    {{ $payment->order->user->name }}
                </p>

                <p class="font-semibold mt-1">
                    Rp {{ number_format($payment->jumlah_bayar,0,',','.') }}
                </p>

            </div>

            <div>

                @if($payment->status == 'belum_lunas')

                    <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm">
                        Belum Lunas
                    </span>

                @else

                    <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm">
                        Lunas
                    </span>

                @endif

            </div>

        </div>

    @empty

        <div class="text-center py-10 text-gray-500">

            Belum ada data pembayaran.

        </div>

    @endforelse

</div>

@endsection
