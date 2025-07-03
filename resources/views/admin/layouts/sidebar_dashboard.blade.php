<aside class="hidden sm:flex sm:flex-col">
    <!-- Logo dengan ukuran terbatas -->
    <a href="/" class="inline-flex items-center justify-center h-20 w-20 bg-green-400 hover:bg-green-500" title="Home">
        <img src="{{ asset('img/dusun-logo.png') }}" alt="Logo Dusun" class="h-12 w-12 object-contain" />
    </a>

    <!-- Sidebar Menu -->
    <div class="flex-grow flex flex-col justify-between text-gray-500 bg-gray-800">
        <nav class="flex flex-col mx-4 my-6 space-y-4">
            <!-- Main -->
            <a href="/main" class="inline-flex items-center justify-center py-3 hover:text-white hover:bg-gray-700 focus:bg-gray-700 focus:text-white rounded-lg" title="Main">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 9.75L12 3l9 6.75v9.75a1.5 1.5 0 01-1.5 1.5H4.5A1.5 1.5 0 013 19.5V9.75z" />
                </svg>
            </a>

            <!-- Blog -->
            <a href="/blog" class="inline-flex items-center justify-center py-3 hover:text-white hover:bg-gray-700 focus:bg-gray-700 focus:text-white rounded-lg" title="Blog">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 10h16M4 14h10M4 18h6" />
                </svg>
            </a>

            <!-- Berita -->
            <a href="/berita" class="inline-flex items-center justify-center py-3 hover:text-white hover:bg-gray-700 focus:bg-gray-700 focus:text-white rounded-lg" title="Berita">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 10H5M19 6H5m14 8H5m6 4H5" />
                </svg>
            </a>

            <!-- User / Akun -->
            <a href="/akun" class="inline-flex items-center justify-center py-3 hover:text-white hover:bg-gray-700 focus:bg-gray-700 focus:text-white rounded-lg" title="Akun">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5.121 17.804A10.973 10.973 0 0112 15c2.43 0 4.665.77 6.879 2.072M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </a>
        </nav>

        <!-- Settings -->
        <div class="inline-flex items-center justify-center h-20 w-20 border-t border-gray-700">
            <button class="p-3 hover:text-gray-400 hover:bg-gray-700 focus:text-white focus:bg-gray-700 rounded-lg" title="Settings">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0a1.724 1.724 0 002.573 1.066c.839-.512 1.906.327 1.494 1.166a1.724 1.724 0 001.065 2.572c.921.3.921 1.603 0 1.902a1.724 1.724 0 00-1.065 2.573c.412.839-.655 1.678-1.494 1.166a1.724 1.724 0 00-2.573 1.065c-.3.921-1.603.921-1.902 0a1.724 1.724 0 00-2.573-1.065c-.839.512-1.906-.327-1.494-1.166a1.724 1.724 0 00-1.065-2.573c-.921-.3-.921-1.603 0-1.902a1.724 1.724 0 001.065-2.573c-.412-.839.655-1.678 1.494-1.166.97.591 2.29.056 2.573-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </button>
        </div>
    </div>
</aside>
