<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CleanGo Laundry</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-blue-800 text-white flex flex-col">

        <div class="p-6 text-center border-b border-blue-700">
            <h1 class="text-3xl font-bold">
                CleanGo
            </h1>

            <p class="text-blue-200 mt-2 text-sm">
                Laundry Management
            </p>
        </div>

        <nav class="flex-1 mt-5">

            <a href="{{ route('dashboard') }}"
               class="block px-6 py-3 hover:bg-blue-700 transition">
                📊 Dashboard
            </a>

            <a href="{{ route('services.index') }}"
               class="block px-6 py-3 hover:bg-blue-700 transition">
                🧺 Service
            </a>

            <a href="#"
               class="block px-6 py-3 hover:bg-blue-700 transition">
                📦 Order
            </a>

            <a href="#"
               class="block px-6 py-3 hover:bg-blue-700 transition">
                💳 Pembayaran
            </a>

            <a href="#"
               class="block px-6 py-3 hover:bg-blue-700 transition">
                📄 Laporan
            </a>

        </nav>

        <div class="p-5 border-t border-blue-700">

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    type="submit"
                    class="w-full bg-red-500 hover:bg-red-600 py-2 rounded-lg">
                    Logout
                </button>

            </form>

        </div>

    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">

        <!-- Navbar -->
        <header class="bg-white shadow px-8 py-5 flex justify-between items-center">

            <h2 class="text-2xl font-bold text-gray-800">
                @yield('title')
            </h2>

            <div class="text-gray-700">
                Selamat Datang,
                <span class="font-semibold">
                    {{ Auth::user()->name }}
                </span>
            </div>

        </header>

        <!-- Isi Halaman -->
        <main class="p-8">

            @yield('content')

        </main>

    </div>

</div>

</body>
</html>
