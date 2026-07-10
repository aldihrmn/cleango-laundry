<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - CleanGo</title>

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

        <!-- Form Register -->
        <form method="POST" action="{{ route('register') }}">

            @csrf

            <!-- Nama -->
            <div class="mb-5">

                <label class="block mb-2 text-sm font-semibold text-sky-700">
                    Nama Lengkap
                </label>

                <div class="relative">

                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 text-sky-500"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5.121 17.804A9 9 0 1118.879 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>

                        </svg>

                    </div>

                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="Masukkan Nama Lengkap"
                        class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none">

                </div>

                @error('name')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror

            </div>

            <!-- Email -->
            <div class="mb-5">

                <label class="block mb-2 text-sm font-semibold text-sky-700">
                    Email
                </label>

                <div class="relative">

                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 text-sky-500"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 8l9 6 9-6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>

                        </svg>

                    </div>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="username"
                        placeholder="Masukkan Email"
                        class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none">

                </div>

                @error('email')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror

            </div>

            <!-- Password -->
            <div class="mb-5">

                <label class="block mb-2 text-sm font-semibold text-sky-700">
                    Password
                </label>

                <div class="relative">

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
                        autocomplete="new-password"
                        placeholder="Masukkan Password"
                        class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none">

                </div>

                @error('password')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror

            </div>

            <!-- Konfirmasi Password -->
            <div class="mb-6">

                <label class="block mb-2 text-sm font-semibold text-sky-700">
                    Konfirmasi Password
                </label>

                <div class="relative">

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
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="Ulangi Password"
                        class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none">

                </div>

            </div>

            <!-- Tombol Register -->
            <button
                type="submit"
                class="w-full py-3 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-bold text-lg shadow-lg hover:shadow-xl transition duration-300">

                DAFTAR

            </button>

        </form>

        <!-- Login -->
        <div class="mt-8 text-center text-gray-600">

            Sudah punya akun?

            <a
                href="{{ route('login') }}"
                class="font-bold text-sky-600 hover:text-sky-800">

                Login

            </a>

        </div>

    </div>

</div>

</body>
</html>
