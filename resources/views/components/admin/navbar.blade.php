<header class="bg-white border-b border-gray-200 shadow-sm px-8 py-5 flex items-center justify-between">

    <!-- Judul -->
    <div>

        <h1 class="text-3xl font-bold text-gray-800">
            @yield('title')
        </h1>

        <p class="text-gray-500 mt-1">
            CleanGo Laundry Management System
        </p>

    </div>

    <!-- Menu Kanan -->
    <div class="flex items-center gap-6">

        <!-- Search -->
        <div class="hidden lg:block relative">

            <input
                type="text"
                placeholder="Cari menu..."
                class="w-72 pl-11 pr-4 py-3 border rounded-xl bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">

            <span class="absolute left-4 top-3.5 text-gray-400">

                🔍

            </span>

        </div>

        <!-- Notifikasi -->
        <button
            class="relative w-12 h-12 rounded-full bg-blue-100 hover:bg-blue-200 transition flex items-center justify-center">

            🔔

            <span class="absolute top-2 right-2 w-3 h-3 bg-red-500 rounded-full animate-pulse"></span>

        </button>

        <!-- Profil -->
        <div class="flex items-center gap-3 bg-gray-50 rounded-xl px-3 py-2 shadow-sm">

            <img
                src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=2563eb&color=ffffff&size=128"
                class="w-12 h-12 rounded-full border-2 border-blue-500"
                alt="Admin">

            <div>

                <h3 class="font-bold text-gray-800">

                    {{ Auth::user()->name }}

                </h3>

                <p class="text-sm text-gray-500">

                    Administrator

                </p>

            </div>

        </div>

    </div>

</header>
