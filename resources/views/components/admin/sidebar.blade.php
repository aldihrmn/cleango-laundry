<aside class="w-72 bg-gradient-to-b from-blue-700 via-blue-800 to-blue-900 text-white min-h-screen flex flex-col shadow-2xl">

    <!-- ================= Logo ================= -->

    <div class="py-8 text-center border-b border-blue-600">

        <img
            src="{{ asset('images/Logo.jpg') }}"
            class="w-24 h-24 mx-auto rounded-full bg-white p-2 shadow-xl"
            alt="Logo">

        <h1 class="text-3xl font-bold mt-4 tracking-wide">
            CleanGo
        </h1>

        <p class="text-blue-200 text-sm">
            Laundry Management System
        </p>

    </div>

    <!-- ================= Menu ================= -->

    <nav class="flex-1 px-5 py-6 space-y-3">

        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-4 px-5 py-3 rounded-2xl transition duration-300
            {{ request()->routeIs('dashboard') ? 'bg-white text-blue-700 shadow-xl font-bold' : 'hover:bg-blue-600 hover:translate-x-1' }}">

            <span class="text-xl">🏠</span>

            Dashboard

        </a>

        <a href="{{ route('services.index') }}"
            class="flex items-center gap-4 px-5 py-3 rounded-2xl transition duration-300
            {{ request()->routeIs('services.*') ? 'bg-white text-blue-700 shadow-xl font-bold' : 'hover:bg-blue-600 hover:translate-x-1' }}">

            <span class="text-xl">🧺</span>

            Service

        </a>

        <a href="{{ route('orders.index') }}"
            class="flex items-center gap-4 px-5 py-3 rounded-2xl transition duration-300
            {{ request()->routeIs('orders.*') ? 'bg-white text-blue-700 shadow-xl font-bold' : 'hover:bg-blue-600 hover:translate-x-1' }}">

            <span class="text-xl">📦</span>

            Order

        </a>

        <a href="{{ route('payments.index') }}"
            class="flex items-center gap-4 px-5 py-3 rounded-2xl transition duration-300
            {{ request()->routeIs('payments.*') ? 'bg-white text-blue-700 shadow-xl font-bold' : 'hover:bg-blue-600 hover:translate-x-1' }}">

            <span class="text-xl">💳</span>

            Payment

        </a>

        <a href="{{ route('reports.index') }}"
            class="flex items-center gap-4 px-5 py-3 rounded-2xl transition duration-300
            {{ request()->routeIs('reports.*') ? 'bg-white text-blue-700 shadow-xl font-bold' : 'hover:bg-blue-600 hover:translate-x-1' }}">

            <span class="text-xl">📊</span>

            Report

        </a>

    </nav>

    <!-- ================= User ================= -->

    <div class="border-t border-blue-600 p-5">

        <div class="flex items-center gap-4 mb-5">

            <img
                src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=ffffff&color=2563eb&size=128"
                class="w-14 h-14 rounded-full shadow-lg"
                alt="User">

            <div>

                <h3 class="font-bold">

                    {{ Auth::user()->name }}

                </h3>

                <p class="text-blue-200 text-sm">

                    {{ Auth::user()->hasRole('admin') ? 'Administrator' : 'Customer' }}

                </p>

            </div>

        </div>

        <form action="{{ route('logout') }}" method="POST">

            @csrf

            <button
                class="w-full bg-red-500 hover:bg-red-600 rounded-xl py-3 font-semibold shadow-lg transition duration-300">

                🚪 Logout

            </button>

        </form>

    </div>

</aside>
