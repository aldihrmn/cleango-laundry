@extends('layouts.admin')

@section('title', 'Data Service')

@section('content')

<<<<<<< Updated upstream
<div class="flex justify-between items-center mb-6">

    <h2 class="text-xl font-bold">
        Daftar Service
    </h2>

    <a href="{{ route('services.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        + Tambah Service
    </a>

</div>
=======
@if(optional(auth()->user())->hasRole('admin'))
    <div class="flex justify-end mb-6">
        <a href="{{ route('services.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl shadow">
            + Tambah Service
        </a>
    </div>
@endif
>>>>>>> Stashed changes

@if(session('success'))
<div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
    {{ session('success') }}
</div>
@endif

<div class="bg-white shadow rounded-lg overflow-hidden">

    <table class="w-full">

        <thead class="bg-gray-100">
            <tr>
<<<<<<< Updated upstream
                <th class="p-3 border">No</th>
                <th class="p-3 border">Nama Layanan</th>
                <th class="p-3 border">Jenis</th>
                <th class="p-3 border">Harga/Kg</th>
                <th class="p-3 border">Estimasi</th>
                <th class="p-3 border">Status</th>
                <th class="p-3 border">Aksi</th>
=======
                <th class="px-5 py-4 text-left">No</th>
                <th class="px-5 py-4 text-left">Nama Layanan</th>
                <th class="px-5 py-4 text-left">Jenis</th>
                <th class="px-5 py-4 text-left">Harga / Kg</th>
                <th class="px-5 py-4 text-left">Estimasi</th>
                <th class="px-5 py-4 text-center">Status</th>
                @if(optional(auth()->user())->hasRole('admin'))
                    <th class="px-5 py-4 text-center">Aksi</th>
                @endif
>>>>>>> Stashed changes
            </tr>
        </thead>

        <tbody>

        @forelse($services as $service)

            <tr>

                <td class="p-3 border text-center">
                    {{ $loop->iteration }}
                </td>

                <td class="p-3 border">
                    {{ $service->nama_layanan }}
                </td>

                <td class="p-3 border">
                    {{ $service->jenis_layanan }}
                </td>

                <td class="p-3 border">
                    Rp {{ number_format($service->harga_per_kg,0,',','.') }}
                </td>

                <td class="p-3 border">
                    {{ $service->estimasi_hari }} Hari
                </td>

                <td class="p-3 border">
                    {{ $service->is_active ? 'Aktif' : 'Tidak Aktif' }}
                </td>

<<<<<<< Updated upstream
                <td class="p-3 border text-center">

                    <a href="{{ route('services.edit',$service->id) }}"
                       class="bg-yellow-500 text-white px-3 py-1 rounded">
                        Edit
                    </a>

                    <form action="{{ route('services.destroy',$service->id) }}"
                          method="POST"
                          class="inline">

                        @csrf
                        @method('DELETE')

                        <button
                            onclick="return confirm('Hapus layanan ini?')"
                            class="bg-red-600 text-white px-3 py-1 rounded">

                            Hapus

                        </button>

                    </form>

                </td>
=======
                @if(optional(auth()->user())->hasRole('admin'))
                    <td class="px-5 py-4">
                        <div class="flex justify-center gap-2">

                            <a href="{{ route('services.edit', $service) }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">
                                Edit
                            </a>

                            <form action="{{ route('services.destroy', $service) }}" method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    onclick="return confirm('Yakin ingin menghapus layanan ini?')"
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
                                    Hapus
                                </button>

                            </form>

                        </div>
                    </td>
                @endif
>>>>>>> Stashed changes

            </tr>

        @empty

            <tr>

                <td colspan="7" class="text-center p-5">
                    Belum ada data service
                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection
