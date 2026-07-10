<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CleanGo</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-sky-100 via-blue-50 to-cyan-100">

<div class="min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl border border-sky-100 p-10">

        <!-- Logo -->
        <div class="text-center mb-8">

            <img
                src="{{ asset('images/Logo.jpg') }}"
                alt="Logo CleanGo"
                class="w-28 h-28 mx-auto object-contain drop-shadow-lg hover:scale-105 transition duration-300">

            <h1 class="mt-4 text-4xl font-extrabold text-sky-700 tracking-wide">
                CleanGo
            </h1>

            <p class="mt-2 text-gray-500 text-lg">
                Laundry Management System
            </p>

        </div>

        <!-- Form Login -->
        <form method="POST" action="{{ route('login') }}">

            @csrf

            <!-- Email -->
            <div class="mb-5">

                <label class="block mb-2 text-sm font-semibold text-sky-700">
                    Email
                </label>

                <div class="relative">

                    <!-- Icon Email -->
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 text-sky-500"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M16 12H8m8-4H8m8 8H8M4 6h16v12H4z"/>

                        </svg>

                    </div>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="Masukkan Email"
                        class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none">

                </div>

                @error('email')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror

            </div>

            <!-- Password -->
            <div class="mb-4">

                <label class="block mb-2 text-sm font-semibold text-sky-700">
                    Password
                </label>

                <div class="relative">

                    <!-- Icon Password -->
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 text-sky-500"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2h-1V9a5 5 0 00-10 0v2H6a2 2 0 00-2 2v6a2 2 0 002 2zm3-10V9a3 3 0 016 0v2H9z"/>

                        </svg>

                    </div>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Masukkan Password"
                        class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none">

                </div>

                @error('password')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror

            </div>

            <!-- Remember -->
            <div class="flex items-center justify-between mb-6">

                <label class="flex items-center">

                    <input
                        type="checkbox"
                        name="remember"
                        class="rounded border-gray-300 text-sky-600 shadow-sm focus:ring-sky-500">

                    <span class="ml-2 text-sm text-gray-600">
                        Ingat Saya
                    </span>

                </label>

                @if (Route::has('password.request'))

                    <a
                        href="{{ route('password.request') }}"
                        class="text-sm text-sky-600 hover:text-sky-800 hover:underline">

                        Lupa Password?

                    </a>

                @endif

            </div>

            <!-- Button Login -->
            <button
                type="submit"
                class="w-full py-3 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-bold text-lg shadow-lg hover:shadow-xl transition duration-300">

                LOGIN

            </button>

        </form>

        <!-- Register -->
        <div class="mt-8 text-center text-gray-600">

            Belum punya akun?

            <a
                href="{{ route('register') }}"
                class="font-bold text-sky-600 hover:text-sky-800">

                Daftar

            </a>

        </div>

    </div>

</div>

</body>

</html>
