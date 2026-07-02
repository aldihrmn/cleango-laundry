<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Customer
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <div class="flex justify-between items-center mb-5">

                    <h3 class="text-xl font-bold">
                        Daftar Customer
                    </h3>

                    <a href="{{ route('customers.create') }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        + Tambah Customer
                    </a>

                </div>

                <table class="w-full border border-collapse">

                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-2">No</th>
                            <th class="border p-2">Nama</th>
                            <th class="border p-2">No HP</th>
                            <th class="border p-2">Email</th>
                            <th class="border p-2">Alamat</th>
                            <th class="border p-2">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($customers as $customer)

                        <tr>

                            <td class="border p-2">{{ $loop->iteration }}</td>
                            <td class="border p-2">{{ $customer->name }}</td>
                            <td class="border p-2">{{ $customer->phone }}</td>
                            <td class="border p-2">{{ $customer->email }}</td>
                            <td class="border p-2">{{ $customer->address }}</td>

                            <td class="border p-2 text-center">

                                <a href="{{ route('customers.edit',$customer->id) }}"
                                   class="bg-yellow-500 text-white px-3 py-1 rounded">
                                    Edit
                                </a>

                                <form action="{{ route('customers.destroy',$customer->id) }}"
                                      method="POST"
                                      class="inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Hapus customer ini?')"
                                        class="bg-red-600 text-white px-3 py-1 rounded">
                                        Hapus
                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="6" class="text-center border p-3">
                                Belum ada data customer.
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</x-app-layout>
