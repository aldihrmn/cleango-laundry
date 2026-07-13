<header class="bg-white border-b border-gray-200 shadow-sm px-8 py-5 flex items-center justify-between">

    {{-- Judul --}}
    <div>
        <h1 class="text-3xl font-bold text-gray-800">
            @yield('title')
        </h1>

        <p class="text-gray-500 mt-1">
            CleanGo Laundry Management System
        </p>
    </div>

    {{-- Menu Kanan --}}
    <div class="flex items-center gap-6">

        {{-- Search Menu --}}
        <div class="hidden lg:block relative">
            <input
                id="menuSearch"
                type="text"
                placeholder="Cari menu..."
                class="w-72 pl-11 pr-4 py-3 border rounded-xl bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">

            <span class="absolute left-4 top-3.5 text-gray-400">
                🔍
            </span>
        </div>

        {{-- Notifikasi --}}
        <div class="relative">

            <button
                id="notificationButton"
                class="relative w-12 h-12 rounded-full bg-blue-100 hover:bg-blue-200 transition flex items-center justify-center">

                🔔

                <span class="absolute top-2 right-2 w-3 h-3 bg-red-500 rounded-full animate-pulse"></span>

            </button>

            <div
                id="notificationMenu"
                class="hidden absolute right-0 mt-3 w-72 bg-white rounded-xl shadow-xl border z-50">

                <div class="p-4 border-b font-bold">
                    Notifikasi
                </div>

                <div class="p-4 text-sm text-gray-600">
                    Tidak ada notifikasi baru.
                </div>

            </div>

        </div>

        {{-- Profil --}}
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
                    {{ Auth::user()->hasRole('admin') ? 'Administrator' : 'Customer' }}
                </p>

            </div>

        </div>

    </div>

</header>

<script>

document.addEventListener('DOMContentLoaded', function () {

    // ================= SEARCH MENU =================

    const search = document.getElementById('menuSearch');

    if(search){

        search.addEventListener('keyup', function(){

            let keyword = this.value.toLowerCase();

            document.querySelectorAll('aside nav a').forEach(function(menu){

                let text = menu.innerText.toLowerCase();

                menu.style.display = text.includes(keyword)
                    ? 'flex'
                    : 'none';

            });

        });

    }

    // ================= NOTIFIKASI =================

    const btn = document.getElementById('notificationButton');
    const menu = document.getElementById('notificationMenu');

    btn.addEventListener('click', function(e){

        e.stopPropagation();

        menu.classList.toggle('hidden');

    });

    document.addEventListener('click', function(){

        menu.classList.add('hidden');

    });

});

</script>
