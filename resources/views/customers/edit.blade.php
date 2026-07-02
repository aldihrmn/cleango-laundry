<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Customer
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('customers.update',$customer->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label>Nama Customer</label>
                        <input type="text"
                               name="name"
                               value="{{ $customer->name }}"
                               class="w-full border rounded px-3 py-2 mt-1">
                    </div>

                    <div class="mb-4">
                        <label>No HP</label>
                        <input type="text"
                               name="phone"
                               value="{{ $customer->phone }}"
                               class="w-full border rounded px-3 py-2 mt-1">
                    </div>

                    <div class="mb-4">
                        <label>Email</label>
                        <input type="email"
                               name="email"
                               value="{{ $customer->email }}"
                               class="w-full border rounded px-3 py-2 mt-1">
                    </div>

                    <div class="mb-4">
                        <label>Alamat</label>
                        <textarea
                            name="address"
                            rows="4"
                            class="w-full border rounded px-3 py-2 mt-1">{{ $customer->address }}</textarea>
                    </div>

                    <button
                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded">
                        Update
                    </button>

                    <a href="{{ route('customers.index') }}"
                       class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded">
                        Kembali
                    </a>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>
