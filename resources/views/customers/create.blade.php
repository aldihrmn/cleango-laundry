<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Customer
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('customers.store') }}" method="POST">

                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium">Nama Customer</label>
                        <input type="text"
                               name="name"
                               class="w-full border rounded px-3 py-2 mt-1"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">No HP</label>
                        <input type="text"
                               name="phone"
                               class="w-full border rounded px-3 py-2 mt-1"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">Email</label>
                        <input type="email"
                               name="email"
                               class="w-full border rounded px-3 py-2 mt-1">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">Alamat</label>
                        <textarea
                            name="address"
                            rows="4"
                            class="w-full border rounded px-3 py-2 mt-1"
                            required></textarea>
                    </div>

                    <div class="flex gap-2">

                        <button
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">
                            Simpan
                        </button>

                        <a href="{{ route('customers.index') }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded">
                            Kembali
                        </a>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>
