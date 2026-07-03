<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Service
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg p-6">

                <div class="flex justify-between items-center mb-5">

                    <h3 class="text-xl font-bold">
                        Daftar Service
                    </h3>

                    <a href="{{ route('services.create') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        + Tambah Service
                    </a>

                </div>

                <table class="w-full border border-collapse">

                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-2">No</th>
                            <th class="border p-2">Nama Service</th>
                            <th class="border p-2">Harga</th>
                            <th class="border p-2">Durasi</th>
                            <th class="border p-2">Deskripsi</th>
                            <th class="border p-2">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($services as $service)

                            <tr>

                                <td class="border p-2 text-center">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="border p-2">
                                    {{ $service->name }}
                                </td>

                                <td class="border p-2">
                                    Rp {{ number_format($service->price, 0, ',', '.') }}
                                </td>

                                <td class="border p-2">
                                    {{ $service->duration }} Hari
                                </td>

                                <td class="border p-2">
                                    {{ $service->description ?? '-' }}
                                </td>

                                <td class="border p-2 text-center">

                                    <a href="{{ route('services.edit', $service->id) }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                                        Edit
                                    </a>

                                    <form action="{{ route('services.destroy', $service->id) }}"
                                        method="POST"
                                        class="inline">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            onclick="return confirm('Yakin ingin menghapus layanan ini?')"
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                            Hapus
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="border p-3 text-center">
                                    Belum ada data service.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</x-app-layout>
