<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Customer
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto">

            <div class="bg-white shadow rounded-lg p-6">

                <p><strong>Nama :</strong> {{ $customer->name }}</p>
                <p><strong>No HP :</strong> {{ $customer->phone }}</p>
                <p><strong>Email :</strong> {{ $customer->email }}</p>
                <p><strong>Alamat :</strong> {{ $customer->address }}</p>

            </div>

        </div>
    </div>
</x-app-layout>
