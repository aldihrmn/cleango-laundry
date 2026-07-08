<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Service
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <h3 class="text-xl font-bold mb-5">
                    Form Edit Service
                </h3>

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 text-red-700 p-4 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('services.update', $service->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-medium mb-2">
                            Nama Layanan
                        </label>

                        <input
                            type="text"
                            name="nama_layanan"
                            value="{{ old('nama_layanan', $service->nama_layanan) }}"
                            class="w-full border rounded p-2"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">
                            Jenis Layanan
                        </label>

                        <input
                            type="text"
                            name="jenis_layanan"
                            value="{{ old('jenis_layanan', $service->jenis_layanan) }}"
                            class="w-full border rounded p-2"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">
                            Harga per Kg
                        </label>

                        <input
                            type="number"
                            name="harga_per_kg"
                            value="{{ old('harga_per_kg', $service->harga_per_kg) }}"
                            class="w-full border rounded p-2"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">
                            Estimasi Hari
                        </label>

                        <input
                            type="number"
                            name="estimasi_hari"
                            value="{{ old('estimasi_hari', $service->estimasi_hari) }}"
                            class="w-full border rounded p-2"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">
                            Deskripsi
                        </label>

                        <textarea
                            name="deskripsi"
                            rows="4"
                            class="w-full border rounded p-2">{{ old('deskripsi', $service->deskripsi) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">
                            Status
                        </label>

                        <select
                            name="is_active"
                            class="w-full border rounded p-2">

                            <option value="1" {{ $service->is_active ? 'selected' : '' }}>
                                Aktif
                            </option>

                            <option value="0" {{ !$service->is_active ? 'selected' : '' }}>
                                Tidak Aktif
                            </option>

                        </select>
                    </div>

                    <div class="flex gap-2">

                        <button
                            type="submit"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded">
                            Update
                        </button>

                        <a href="{{ route('services.index') }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded">
                            Kembali
                        </a>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>
