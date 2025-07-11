<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Learnify - Register</title>
    @vite('resources/css/app.css')
    <style>
        :root {
            --primary-color: #2e7d32;
            --secondary-color: #a5d6a7;
        }
    </style>
</head>
<body class="bg-white">

<div class="lg:flex h-screen overflow-hidden">
    {{-- Form Section --}}
    <div class="w-full lg:w-1/2 flex flex-col justify-center px-6 lg:px-16 overflow-auto">
        {{-- Logo --}}
        <div class="py-4 flex items-center">
            <img src="{{ asset('img/dusun-logo.png') }}" alt="Logo Dusun" class="w-10 h-10 mr-2">
            <h1 class="text-2xl font-bold" style="color: var(--primary-color)">Gayam</h1>
        </div>

        {{-- Heading --}}
        <div class="mt-2">
            <h2 class="text-3xl font-semibold mb-4" style="color: var(--primary-color)">Register</h2>

            {{-- Form --}}
            <form method="POST" action="{{ route('handle-register') }}">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Username --}}
                    <div>
                        <label for="username" class="text-sm font-semibold text-gray-700">Username</label>
                        <input type="text" name="username" id="username"
                               class="w-full py-2 border-b border-gray-300 text-lg focus:outline-none focus:border-green-600"
                               placeholder="Username kamu" required>
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="text-sm font-semibold text-gray-700">Email</label>
                        <input type="email" name="email" id="email"
                               class="w-full py-2 border-b border-gray-300 text-lg focus:outline-none focus:border-green-600"
                               placeholder="email@example.com" required>
                    </div>

                    {{-- Nomor Telepon --}}
                    <div>
                        <label for="phone" class="text-sm font-semibold text-gray-700">Nomor Telepon</label>
                        <input type="text" name="phone" id="phone"
                               class="w-full py-2 border-b border-gray-300 text-lg focus:outline-none focus:border-green-600"
                               placeholder="08xxxxxxxxxx" required>
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div>
                        <label for="birthdate" class="text-sm font-semibold text-gray-700">Tanggal Lahir</label>
                        <input type="date" name="birthdate" id="birthdate"
                               class="w-full py-2 border-b border-gray-300 text-lg focus:outline-none focus:border-green-600" required>
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="text-sm font-semibold text-gray-700">Password</label>
                        <input type="password" name="password" id="password"
                               class="w-full py-2 border-b border-gray-300 text-lg focus:outline-none focus:border-green-600"
                               placeholder="Enter your password" required>
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label for="password_confirmation" class="text-sm font-semibold text-gray-700">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="w-full py-2 border-b border-gray-300 text-lg focus:outline-none focus:border-green-600"
                               placeholder="Confirm your password" required>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="mt-6">
                    <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 w-full rounded-full shadow-lg transition duration-300">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Image Section --}}
    <div class="hidden lg:flex w-1/2 items-center justify-center bg-cover bg-center"
         style="background-image: url('{{ asset('img/assets/jumbotron.png') }}');">
        <img src="{{ asset('img/dusun-logo.png') }}" alt="Logo Dusun"
             class="w-[400px] transition-transform duration-200 hover:scale-105 rounded-xl">
    </div>
</div>

</body>
</html>
