<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'Dashboard')</title>

    @vite('resources/css/app.css')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="flex bg-gray-100 min-h-screen text-gray-800">
    {{-- Sidebar --}}
    @include('admin.layouts.sidebar_dashboard')

    {{-- Main Content Area --}}
    <div class="flex-grow flex flex-col">
        {{-- Navbar --}}
        @include('admin.layouts.navbar_dashboard')

        {{-- Content --}}
        <main class="p-6 sm:p-10 space-y-6">
            @yield('content')
        </main>

       {{-- Footer --}}
<footer class="bg-white border-t border-gray-200 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-col md:flex-row justify-between items-center text-sm text-gray-500">
        <div class="mb-2 md:mb-0">
            <span class="text-gray-600">&copy; {{ date('Y') }} <span class="text-purple-600 font-semibold">Gayamharjo</span>. All rights reserved.</span>
        </div>
        {{-- <div class="space-x-4">
            <a href="#" class="hover:text-purple-600 transition">Privacy</a>
            <a href="#" class="hover:text-purple-600 transition">Terms</a>
            <a href="#" class="hover:text-purple-600 transition">Support</a>
        </div> --}}
    </div>
</footer>

        {{-- Toast Notification --}}
        @if(session('toast'))
            <div 
                x-data="{ show: true }"
                x-show="show"
                x-init="setTimeout(() => show = false, 3000)"
                x-transition
                class="fixed top-4 right-4 z-[9999] px-4 py-3 rounded shadow-lg text-white text-sm
                    @if(session('toast.type') === 'success') bg-green-600
                    @elseif(session('toast.type') === 'error') bg-red-600
                    @else bg-gray-700 @endif">
                {{ session('toast.message') }}
                <button @click="show = false" class="ml-2 font-bold">×</button>
            </div>
        @endif

        {{-- Extra Scripts --}}
        @yield('scripts')
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const hamburgerBtn = document.getElementById("hamburgerBtn");
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("overlay");

        hamburgerBtn.addEventListener("click", function () {
            sidebar.classList.toggle("hidden");
            overlay.classList.toggle("hidden");
        });

        overlay.addEventListener("click", function () {
            sidebar.classList.add("hidden");
            overlay.classList.add("hidden");
        });
    });
</script>

</body>
</html>
