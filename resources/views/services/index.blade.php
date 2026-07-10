@extends('layouts.admin')

@section('title', 'Data Service')

@section('content')

<div class="flex justify-between items-center mb-6">

    <div>
        <h2 class="text-2xl font-bold text-gray-800">
            Data Service
        </h2>

        <p class="text-gray-500">
            Kelola seluruh layanan CleanGo Laundry.
        </p>
    </div>

    <a href="{{ route('services.create') }}"
        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl shadow">

        + Tambah Service

    </a>

</div>

@if(session('success'))

<div class="mb-5 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl">

    {{ session('success') }}

</div>

@endif

{{-- Search & Filter --}}
<div class="bg-white rounded-2xl shadow p-5 mb-6">

    <form method="GET" action="{{ route('services.index') }}">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

            <div>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama layanan..."
                    class="w-full border rounded-lg px-4 py-2">

            </div>

            <div>

                <select
                    name="jenis_layanan"
                    class="w-full border rounded-lg px-4 py-2">

                    <option value="">Semua Jenis</option>

                    @foreach($jenisLayanan as $jenis)

                        <option
                            value="{{ $jenis }}"
                            {{ request('jenis_layanan') == $jenis ? 'selected' : '' }}>

                            {{ $jenis }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div>

                <select
                    name="status"
                    class="w-full border rounded-lg px-4 py-2">

                    <option value="">Semua Status</option>

                    <option value="1"
                        {{ request('status') === '1' ? 'selected' : '' }}>
                        Aktif
                    </option>

                    <option value="0"
                        {{ request('status') === '0' ? 'selected' : '' }}>
                        Tidak Aktif
                    </option>

                </select>

            </div>

            <div class="flex gap-2">

                <button
                    type="submit"
                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">

                    Filter

                </button>

                <a
                    href="{{ route('services.index') }}"
                    class="flex-1 bg-gray-500 hover:bg-gray-600 text-white rounded-lg flex items-center justify-center">

                    Reset

                </a>

            </div>

        </div>

    </form>

</div>

{{-- Table --}}
<div class="bg-white rounded-2xl shadow overflow-hidden">

    <table class="min-w-full">

        <thead class="bg-blue-600 text-white">

            <tr>

                <th class="px-4 py-3">No</th>
                <th class="px-4 py-3">Nama Layanan</th>
                <th class="px-4 py-3">Jenis</th>
                <th class="px-4 py-3">Harga / Kg</th>
                <th class="px-4 py-3">Estimasi</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3 text-center">Aksi</th>

            </tr>

        </thead>

        <tbody>

            @forelse($services as $service)

            <tr class="border-b hover:bg-gray-50">

                <td class="px-4 py-3 text-center">

                    {{ $services->firstItem() + $loop->index }}

                </td>

                <td class="px-4 py-3 font-semibold">

                    {{ $service->nama_layanan }}

                </td>

                <td class="px-4 py-3">

                    {{ $service->jenis_layanan }}

                </td>

                <td class="px-4 py-3">

                    Rp {{ number_format($service->harga_per_kg,0,',','.') }}

                </td>

                <td class="px-4 py-3">

                    {{ $service->estimasi_hari }} Hari

                </td>

                <td class="px-4 py-3">

                    @if($service->is_active)

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                            Aktif
                        </span>

                    @else

                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                            Tidak Aktif
                        </span>

                    @endif

                </td>

                <td class="px-4 py-3">

                    <div class="flex justify-center gap-2">

                        <a
                            href="{{ route('services.edit',$service->id) }}"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">

                            Edit

                        </a>

                        <form
                            action="{{ route('services.destroy',$service->id) }}"
                            method="POST">

                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('Hapus layanan ini?')"
                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">

                                Hapus

                            </button>

                        </form>

                    </div>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="7" class="text-center py-8 text-gray-500">

                    Data service tidak ditemukan.

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

{{-- Pagination --}}
<div class="mt-6">

    {{ $services->links() }}

</div>

@endsection
