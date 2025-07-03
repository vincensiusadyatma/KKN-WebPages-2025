<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Travel Agency')</title>
    <link rel="icon" type="image/x-icon" href='{{ asset('img/dusun-logo.png') }}'>
    @vite('resources/css/app.css')
    
<body class="bg-white text-gray-900 font-sans leading-normal">

    @include('main.layouts.navbar_main')

    <main>
        @yield('content')
    </main>

     @include('main.layouts.footer_main')

</body>
</html>
