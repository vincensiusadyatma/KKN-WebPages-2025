<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
        
        <!-- Logo Kiri -->
        <div class="flex items-center space-x-3">
            {{-- <svg class="text-blue-700" width="32px" height="32px" viewBox="0 0 24 24" fill="none">
                <path stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                    d="M9 17H15M3 14.6V12.13C3 10.98 3 10.41 3.15 9.88C3.28 9.41 3.5 8.97 3.78 8.58C4.11 8.14 4.56 7.78 5.47 7.08L8.07 5.06C9.48 3.96 10.18 3.42 10.95 3.21C11.64 3.02 12.36 3.02 13.05 3.21C13.82 3.42 14.52 3.96 15.93 5.06L18.53 7.08C19.44 7.78 19.89 8.14 20.22 8.58C20.51 8.97 20.72 9.41 20.85 9.88C21 10.41 21 10.98 21 12.13V14.6C21 16.84 21 17.96 20.56 18.82C20.18 19.57 19.57 20.18 18.82 20.56C17.96 21 16.84 21 14.6 21H9.4C7.16 21 6.04 21 5.18 20.56C4.43 20.18 3.82 19.57 3.44 18.82C3 17.96 3 16.84 3 14.6Z" />
            </svg> --}}
            <img src="{{ asset('img/dusun-logo.png')}}" alt="" width="70px" height="70px">
            <span class="text-2xl font-bold text-lime-700">Dusun Parangan</span>
        </div>

        <!-- Menu Tengah -->
        <ul class="absolute left-1/2 transform -translate-x-1/2 hidden md:flex space-x-8 text-gray-600 font-medium">
            <li><a href="#" class="hover:text-lime-600 transition">Home</a></li>
            <li><a href="#" class="hover:text-lime-600 transition">About</a></li>
            <li><a href="#" class="hover:text-lime-600 transition">Blog</a></li>
            <li><a href="#" class="hover:text-lime-600 transition">Berita</a></li>
        </ul>

        <!-- User / Login Kanan -->
        <div class="relative">
            @auth
                <button type="button"
                        class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-blue-400"
                        id="user-menu-button">
                    <img class="w-10 h-10 rounded-full border"
                         src="{{ auth()->user()->photo_path ? asset('storage/users/photo-profile/' . auth()->user()->photo_path) : asset('img/assets/profile1.png') }}"
                         alt="User">
                </button>

                <div id="user-dropdown"
                     class="absolute right-0 mt-3 w-56 hidden bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                    <div class="p-4">
                        <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->username }}</p>
                        <p class="text-sm text-gray-500 truncate">{{ auth()->user()->email }}</p>
                    </div>
                    <ul class="py-2 text-sm text-gray-600">
                        @if(auth()->user()->roles->contains('name', 'user'))
                            <li><a href="{{ route('show-dashboard') }}" class="block px-4 py-2 hover:bg-gray-100">Dashboard</a></li>
                        @endif
                        @if(auth()->user()->roles->contains('name', 'admin'))
                            <li><a href="{{ route('show-dashboard') }}" class="block px-4 py-2 hover:bg-gray-100">Dashboard Admin</a></li>
                        @endif
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Profile</a></li>
                        <li>
                            <form method="POST" action="{{ route('handle-logout') }}">
                                @csrf
                                <button type="submit"
                                        class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth

            @guest
                <a href="{{ route('show-login') }}"
                   class="px-5 py-2 bg-lime-600 text-white text-sm rounded-full hover:bg-lime-800 transition font-medium">
                    Login
                </a>
            @endguest
        </div>
    </div>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const button = document.getElementById("user-menu-button");
        const dropdown = document.getElementById("user-dropdown");

        if (button && dropdown) {
            button.addEventListener("click", () => {
                dropdown.classList.toggle("hidden");
            });

            document.addEventListener("click", (e) => {
                if (!button.contains(e.target) && !dropdown.contains(e.target)) {
                    dropdown.classList.add("hidden");
                }
            });
        }
    });
</script>
