@extends('layouts.admin')

@section('title', 'Data Customer')

@section('content')

<div class="flex justify-between items-center mb-6">

    <h2 class="text-xl font-bold">
        Daftar Customer
    </h2>

    <a href="{{ route('customers.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        + Tambah Customer
    </a>

</div>

<div class="bg-white shadow rounded-lg overflow-hidden">

    <table class="w-full">

        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 border">No</th>
                <th class="p-3 border">Nama</th>
                <th class="p-3 border">No HP</th>
                <th class="p-3 border">Email</th>
                <th class="p-3 border">Alamat</th>
                <th class="p-3 border">Aksi</th>
            </tr>
        </thead>

        <tbody>

        @forelse($customers as $customer)

            <tr>
                <td class="p-3 border text-center">{{ $loop->iteration }}</td>
                <td class="p-3 border">{{ $customer->name }}</td>
                <td class="p-3 border">{{ $customer->phone }}</td>
                <td class="p-3 border">{{ $customer->email }}</td>
                <td class="p-3 border">{{ $customer->address }}</td>

                <td class="p-3 border text-center">

                    <a href="{{ route('customers.edit', $customer->id) }}"
                       class="bg-yellow-500 text-white px-3 py-1 rounded">
                        Edit
                    </a>

                    <form action="{{ route('customers.destroy', $customer->id) }}"
                          method="POST"
                          class="inline">
                        @csrf
                        @method('DELETE')

                        <button class="bg-red-600 text-white px-3 py-1 rounded"
                                onclick="return confirm('Hapus customer?')">
                            Hapus
                        </button>
                    </form>

                </td>
            </tr>

        @empty

            <tr>
                <td colspan="6" class="text-center p-5">
                    Belum ada data customer
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection
