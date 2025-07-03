<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learnify - Register</title>
    @vite('resources/css/app.css')
    <style>
        :root {
            --primary-color: #2e7d32; /* Hijau tua */
            --secondary-color: #a5d6a7; /* Hijau muda */
        }
    </style>
</head>
<body class="bg-white">

    <div class="lg:flex min-h-screen">
        {{-- Form Section --}}
        <div class="w-full lg:w-1/2 flex flex-col justify-center px-6 lg:px-20">
            {{-- Logo --}}
            <div class="py-6 flex items-center">
                <img src="{{ asset('img/dusun-logo.png') }}" alt="Logo Dusun" class="w-10 h-10 mr-2">
                <h1 class="text-2xl font-bold" style="color: var(--primary-color)">Gayam</h1>
            </div>

            {{-- Heading --}}
            <div class="mt-4">
                <h2 class="text-4xl font-semibold mb-6" style="color: var(--primary-color)">Register</h2>

                {{-- Form --}}
                <form method="POST" action="#">
                    @csrf

                    {{-- Email --}}
                    <div class="mb-6">
                        <label for="email" class="text-sm font-semibold text-gray-700">Email</label>
                        <input type="email" name="email" id="email"
                            class="w-full py-2 border-b border-gray-300 text-lg focus:outline-none focus:border-green-600"
                            placeholder="email@example.com" required>
                    </div>

                    {{-- Password --}}
                    <div class="mb-6">
                        <label for="password" class="text-sm font-semibold text-gray-700">Password</label>
                        <input type="password" name="password" id="password"
                            class="w-full py-2 border-b border-gray-300 text-lg focus:outline-none focus:border-green-600"
                            placeholder="Enter your password" required>
                    </div>

                    {{-- Confirm Password --}}
                    <div class="mb-6">
                        <label for="password_confirmation" class="text-sm font-semibold text-gray-700">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="w-full py-2 border-b border-gray-300 text-lg focus:outline-none focus:border-green-600"
                            placeholder="Confirm your password" required>
                    </div>

                    {{-- Submit --}}
                    <div class="mt-8">
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
                 class="w-[500px] transition-transform duration-200 hover:scale-105 rounded-xl">
        </div>
    </div>

</body>
</html>
