<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'Dashboard')</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex bg-gray-100 min-h-screen">
    @include('admin.layouts.sidebar_dashboard')

    <div class="flex-grow text-gray-800">
        @include('admin.layouts.navbar_dashboard')

        <main class="p-6 sm:p-10 space-y-6">
            @yield('content')
        </main>
    </div>
</body>
</html>
