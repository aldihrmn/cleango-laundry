@extends('layouts.admin')

@section('title', 'Tambah Order')

@section('content')

<div class="flex justify-between items-center mb-6">

    <div>

        <h1 class="text-3xl font-bold text-gray-800">
            Tambah Order
        </h1>

        <p class="text-gray-500 mt-1">
            Tambahkan data order baru CleanGo Laundry.
        </p>

    </div>

    <a href="{{ route('orders.index') }}"
        class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-3 rounded-xl shadow">

        Kembali

    </a>

</div>

@if ($errors->any())

<div class="bg-red-100 border border-red-300 text-red-700 rounded-xl p-4 mb-6">

    <ul class="list-disc ml-5">

        @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<div class="bg-white rounded-2xl shadow-lg p-8">

    <form action="{{ route('orders.store') }}" method="POST">

        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <label class="block font-semibold mb-2">
                    Customer
                </label>
                <div class="w-full border rounded-xl px-4 py-3 bg-gray-50 text-gray-700">
                    {{ auth()->user()->name }}
                </div>
            </div>

            <div>
                <label class="block font-semibold mb-2">
                    Layanan
                </label>
                <select
                    name="service_id"
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    required>
                    <option value="">Pilih Layanan</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" data-price="{{ $service->harga_per_kg }}" data-estimasi="{{ $service->estimasi_hari }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                            {{ $service->nama_layanan }} - Rp {{ number_format($service->harga_per_kg,0,',','.') }} /kg - Estimasi {{ $service->estimasi_hari }} hari
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-semibold mb-2">
                    Jumlah (Qty)
                </label>
                <input
                    type="number"
                    id="qty"
                    name="qty"
                    value="{{ old('qty', 1) }}"
                    min="1"
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    required>
            </div>

            <div>
                <label class="block font-semibold mb-2">
                    Berat (kg)
                </label>
                <input
                    type="number"
                    step="0.01"
                    name="berat"
                    value="{{ old('berat', 1) }}"
                    min="0"
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block font-semibold mb-2">
                    Kode Order
                </label>

                <input
                    type="text"
                    name="kode_order"
                    value="{{ old('kode_order') }}"
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    required>

            </div>

            <div>

                <label class="block font-semibold mb-2">

                    Tanggal Order

                </label>

                <input
                    type="date"
                    id="tanggal_order"
                    name="tanggal_order"
                    value="{{ old('tanggal_order', date('Y-m-d')) }}"
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    required>

            </div>

            <div>
                <label class="block font-semibold mb-2">
                    Estimasi Selesai
                </label>
                <input
                    type="text"
                    id="estimasi_selesai_display"
                    value=""
                    class="w-full border rounded-xl px-4 py-3 bg-gray-100 text-gray-700 focus:outline-none"
                    readonly>
                <input type="hidden" name="estimasi_selesai" id="estimasi_selesai" value="">
            </div>

            <div>

                <label class="block font-semibold mb-2">

                    Status

                </label>

                <select
                    name="status"
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                    <option value="Menunggu">Menunggu</option>
                    <option value="Diproses">Diproses</option>
                    <option value="Dicuci">Dicuci</option>
                    <option value="Dikeringkan">Dikeringkan</option>
                    <option value="Disetrika">Disetrika</option>
                    <option value="Selesai">Selesai</option>
                    <option value="Diambil">Diambil</option>

                </select>

            </div>

            <div>

                <label class="block font-semibold mb-2">

                    Pickup Type

                </label>

                <select
                    name="pickup_type"
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                    <option value="Antar">Antar</option>

                    <option value="Jemput">Jemput</option>

                </select>

            </div>

            <div class="md:col-span-2">
                <label class="block font-semibold mb-2">
                    Total Harga
                </label>
                <div id="totalHargaDisplay" class="rounded-xl border border-gray-200 bg-gray-50 p-4 text-2xl font-bold text-green-700">
                    Rp 0
                </div>
                <input type="hidden" name="total_harga" id="total_harga" value="{{ old('total_harga', 0) }}">
            </div>

            <div class="md:col-span-2">
                <label class="block font-semibold mb-2">
                    Catatan
                </label>

                <textarea
                    name="catatan"
                    rows="4"
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('catatan') }}</textarea>

            </div>

        </div>

        <div class="mt-8 flex gap-4">

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl shadow transition">

                Simpan Order

            </button>

            <a
                href="{{ route('orders.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-xl shadow transition">

                Batal

            </a>

        </div>

    </form>

</div>

<script>
    function calculateTotalHarga() {
        const serviceSelect = document.querySelector('select[name="service_id"]');
        const qtyInput = document.getElementById('qty');
        const beratInput = document.querySelector('input[name="berat"]');
        const tanggalOrderInput = document.getElementById('tanggal_order');
        const totalHargaInput = document.getElementById('total_harga');
        const totalHargaDisplay = document.getElementById('totalHargaDisplay');
        const estimasiInput = document.getElementById('estimasi_selesai');
        const estimasiDisplay = document.getElementById('estimasi_selesai_display');

        const selectedOption = serviceSelect?.selectedOptions[0];
        const pricePerKg = selectedOption ? Number(selectedOption.dataset.price || 0) : 0;
        const estimasiHari = selectedOption ? Number(selectedOption.dataset.estimasi || 0) : 0;
        const qty = Number(qtyInput?.value) || 1;
        const berat = Number(beratInput?.value) || 1;
        const total = pricePerKg * Math.max(berat, 1) * Math.max(qty, 1);
        const tanggalOrder = tanggalOrderInput?.value ? new Date(tanggalOrderInput.value) : new Date();

        if (totalHargaInput) {
            totalHargaInput.value = total;
        }
        if (totalHargaDisplay) {
            totalHargaDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        if (estimasiInput && estimasiDisplay) {
            if (selectedOption && estimasiHari > 0 && tanggalOrderInput?.value) {
                const selesaiDate = new Date(tanggalOrder);
                selesaiDate.setDate(selesaiDate.getDate() + estimasiHari);
                const year = selesaiDate.getFullYear();
                const month = String(selesaiDate.getMonth() + 1).padStart(2, '0');
                const day = String(selesaiDate.getDate()).padStart(2, '0');
                const formattedDate = `${year}-${month}-${day}`;
                estimasiInput.value = formattedDate;
                estimasiDisplay.value = `${day}/${month}/${year}`;
            } else {
                estimasiInput.value = '';
                estimasiDisplay.value = '';
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const serviceSelect = document.querySelector('select[name="service_id"]');
        const qtyInput = document.getElementById('qty');
        const beratInput = document.querySelector('input[name="berat"]');

        const tanggalOrderInput = document.getElementById('tanggal_order');

        if (serviceSelect) serviceSelect.addEventListener('change', calculateTotalHarga);
        if (qtyInput) qtyInput.addEventListener('input', calculateTotalHarga);
        if (beratInput) beratInput.addEventListener('input', calculateTotalHarga);
        if (tanggalOrderInput) tanggalOrderInput.addEventListener('input', calculateTotalHarga);

        calculateTotalHarga();
    });
</script>

@endsection
