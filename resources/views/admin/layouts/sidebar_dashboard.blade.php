<aside id="sidebar"
    class="hidden sm:flex sm:flex-col fixed top-0 left-0 z-50 bg-gray-800 w-64 h-full sm:relative sm:top-auto sm:left-auto sm:h-auto sm:w-auto"
>
<!-- Logo -->
<a href="/" class="flex items-center justify-center h-20 w-full sm:w-20 bg-green-400 hover:bg-green-500" title="Home">
    <img src="{{ asset('img/dusun-logo.png') }}" alt="Logo Dusun" class="h-12 w-12 object-contain" />
</a>


    <!-- Sidebar Menu -->
    <div class="flex-grow flex flex-col justify-between text-gray-500 bg-gray-800">
        <!-- Top Navigation -->
        <nav class="flex flex-col mx-4 my-6 space-y-4">
            <!-- Dashboard -->
            <a href="/dashboard"
               class="inline-flex items-center justify-center py-3 rounded-lg transition
               {{ request()->is('dashboard') ? 'text-white bg-gray-700' : 'hover:text-white hover:bg-gray-700 text-gray-400' }}"
               title="Dashboard">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 9.75L12 3l9 6.75v9.75a1.5 1.5 0 01-1.5 1.5H4.5A1.5 1.5 0 013 19.5V9.75z" />
                </svg>
            </a>

            <!-- Blog -->
            <a href="/dashboard/blog"
               class="inline-flex items-center justify-center py-3 rounded-lg transition
               {{ request()->is('dashboard/blog*') ? 'text-white bg-gray-700' : 'hover:text-white hover:bg-gray-700 text-gray-400' }}"
               title="Blog">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 20H5a2 2 0 01-2-2V7a2 2 0 012-2h7m0 15h7a2 2 0 002-2V7a2 2 0 00-2-2h-7m0 15V5" />
                </svg>
            </a>

            <!-- Berita -->
            <a href="/dashboard/berita"
               class="inline-flex items-center justify-center py-3 rounded-lg transition
               {{ request()->is('dashboard/berita*') ? 'text-white bg-gray-700' : 'hover:text-white hover:bg-gray-700 text-gray-400' }}"
               title="Berita">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46" />
                </svg>
            </a>

            <!-- Admin Management -->
            <a href="/dashboard/admin_management"
               class="inline-flex items-center justify-center py-3 rounded-lg transition
               {{ request()->is('dashboard/admin_management*') ? 'text-white bg-gray-700' : 'hover:text-white hover:bg-gray-700 text-gray-400' }}"
               title="Akun">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M5.121 17.804A10.973 10.973 0 0112 15c2.43 0 4.665.77 6.879 2.072M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </a>
        </nav>

        <!-- Bottom Section: Back + Settings -->
        <div class="flex flex-col items-center border-t border-gray-700">
            <!-- Back to Main -->
            <a href="/" title="Kembali ke Halaman Utama"
               class="w-full flex items-center justify-center h-20 hover:text-white hover:bg-gray-700 text-gray-400 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>

                    <!-- Settings -->
            <a href="{{ route('settings') }}"
            class="inline-flex items-center justify-center py-3 rounded-lg transition
            {{ request()->is('dashboard/settings') ? 'text-white bg-gray-700' : 'hover:text-white hover:bg-gray-700 text-gray-400' }}"
            title="Settings">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c1.657 0 3-1.343 3-3S13.657 2 12 2 9 3.343 9 5s1.343 3 3 3zm0 2c-2.21 0-4 1.79-4 4v4h8v-4c0-2.21-1.79-4-4-4z" />
            </svg>
            </a>

        </div>
    </div>
</aside>


