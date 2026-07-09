@extends('layouts.admin')

@section('title','Data Order')

@section('content')

<div class="bg-white rounded-xl shadow p-6">

    <h2 class="text-2xl font-bold mb-5">
        Data Order
    </h2>

    <div class="flex gap-2 mb-5">

        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg">
            Semua
        </button>

        <button class="px-4 py-2 bg-gray-200 rounded-lg">
            Baru
        </button>

        <button class="px-4 py-2 bg-gray-200 rounded-lg">
            Proses
        </button>

        <button class="px-4 py-2 bg-gray-200 rounded-lg">
            Selesai
        </button>

    </div>

    <table class="w-full">

        <thead class="bg-gray-100">

            <tr>

                <th class="p-3">Kode</th>
                <th class="p-3">Customer</th>
                <th class="p-3">Tanggal</th>
                <th class="p-3">Total</th>
                <th class="p-3">Status</th>

            </tr>

        </thead>

        <tbody>

        @forelse($orders as $order)

            <tr class="border-b">

                <td class="p-3">
                    {{ $order->kode_order }}
                </td>

                <td class="p-3">
                    {{ $order->user->name }}
                </td>

                <td class="p-3">
                    {{ $order->tanggal_order }}
                </td>

                <td class="p-3">
                    Rp {{ number_format($order->total_harga,0,',','.') }}
                </td>

                <td class="p-3">

                    @if($order->status=='baru')

                        <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full">
                            Baru
                        </span>

                    @elseif($order->status=='proses')

                        <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full">
                            Proses
                        </span>

                    @else

                        <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full">
                            Selesai
                        </span>

                    @endif

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="5" class="text-center py-5">
                    Belum ada order.
                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection
