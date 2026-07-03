@extends('layouts.admin')

@section('title', 'Data Service')

@section('content')

<div class="flex justify-between items-center mb-6">

    <h2 class="text-xl font-bold">
        Daftar Service
    </h2>

    <a href="{{ route('services.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        + Tambah Service
    </a>

</div>

<div class="bg-white shadow rounded-lg overflow-hidden">

    <table class="w-full">

        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 border">No</th>
                <th class="p-3 border">Nama Service</th>
                <th class="p-3 border">Harga</th>
                <th class="p-3 border">Durasi</th>
                <th class="p-3 border">Deskripsi</th>
                <th class="p-3 border">Aksi</th>
            </tr>
        </thead>

        <tbody>

        @forelse($services as $service)

            <tr>
                <td class="p-3 border text-center">{{ $loop->iteration }}</td>
                <td class="p-3 border">{{ $service->name }}</td>
                <td class="p-3 border">Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                <td class="p-3 border">{{ $service->duration }} Jam</td>
                <td class="p-3 border">{{ $service->description }}</td>

                <td class="p-3 border text-center">

                    <a href="{{ route('services.edit', $service->id) }}"
                       class="bg-yellow-500 text-white px-3 py-1 rounded">
                        Edit
                    </a>

                    <form action="{{ route('services.destroy', $service->id) }}"
                          method="POST"
                          class="inline">
                        @csrf
                        @method('DELETE')

                        <button class="bg-red-600 text-white px-3 py-1 rounded"
                                onclick="return confirm('Hapus service?')">
                            Hapus
                        </button>

                    </form>

                </td>
            </tr>

        @empty

            <tr>
                <td colspan="6" class="text-center p-5">
                    Belum ada data service
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection
