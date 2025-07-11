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
</body>
</html>
