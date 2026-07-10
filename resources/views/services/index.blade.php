@extends('layouts.admin')

@section('title', 'Data Service')

@section('content')

<div class="flex justify-between items-center mb-6">

    <div>
        <p class="text-gray-500">
            Kelola semua layanan CleanGo Laundry.
        </p>
    </div>

    <a href="{{ route('services.create') }}"
        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl shadow">

        + Tambah Service

    </a>

</div>

@if(session('success'))

<div class="bg-green-100 border border-green-300 text-green-700 rounded-xl px-4 py-3 mb-5">

    {{ session('success') }}

</div>

@endif

<div class="bg-white rounded-2xl shadow overflow-hidden">

    <table class="min-w-full">

        <thead class="bg-blue-600 text-white">

            <tr>

                <th class="px-5 py-4 text-left">No</th>

                <th class="px-5 py-4 text-left">Nama Layanan</th>

                <th class="px-5 py-4 text-left">Jenis</th>

                <th class="px-5 py-4 text-left">Harga / Kg</th>

                <th class="px-5 py-4 text-left">Estimasi</th>

                <th class="px-5 py-4 text-center">Status</th>

                <th class="px-5 py-4 text-center">Aksi</th>

            </tr>

        </thead>

        <tbody>

            @forelse($services as $service)

            <tr class="border-b hover:bg-gray-50">

                <td class="px-5 py-4">

                    {{ $loop->iteration }}

                </td>

                <td class="px-5 py-4 font-semibold">

                    {{ $service->nama_layanan }}

                </td>

                <td class="px-5 py-4">

                    {{ $service->jenis_layanan }}

                </td>

                <td class="px-5 py-4">

                    Rp {{ number_format($service->harga_per_kg,0,',','.') }}

                </td>

                <td class="px-5 py-4">

                    {{ $service->estimasi_hari }} Hari

                </td>

                <td class="px-5 py-4 text-center">

                    @if($service->is_active)

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                            Aktif

                        </span>

                    @else

                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">

                            Nonaktif

                        </span>

                    @endif

                </td>

                <td class="px-5 py-4">

                    <div class="flex justify-center gap-2">

                        <a href="{{ route('services.edit',$service) }}"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">

                            Edit

                        </a>

                        <form
                            action="{{ route('services.destroy',$service) }}"
                            method="POST">

                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('Yakin ingin menghapus layanan ini?')"
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">

                                Hapus

                            </button>

                        </form>

                    </div>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="7" class="text-center py-8 text-gray-500">

                    Belum ada data layanan.

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection
