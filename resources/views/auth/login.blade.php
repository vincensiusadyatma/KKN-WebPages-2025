<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Learnify</title>
    @vite('resources/css/app.css')
    <style>
        :root {
            --primary-color: #2e7d32; /* Hijau tua */
            --accent-color: #81c784;  /* Hijau lembut */
        }
      body {
        background-image: url('{{ asset('img/gayamharjo-login-bg.png') }}');
        background-size: cover;
        background-position: center;
    }
        .backdrop {
            backdrop-filter: blur(8px);
            background-color: rgba(255, 255, 255, 0.85);
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">

    {{-- Modal Container --}}
    <div class="backdrop rounded-lg shadow-xl p-6 w-full max-w-sm">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold tracking-wide text-[var(--primary-color)]">Login</h2>
            <a href="{{route('show-register')}}" class="text-sm text-[var(--primary-color)] hover:underline">Daftar</a>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('handle-login') }}">
            @csrf

            {{-- Email / Username --}}
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email atau Username</label>
                <input type="text" id="email" name="email" required
                    class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 shadow-sm focus:outline-none focus:ring-2 focus:ring-[var(--primary-color)] focus:border-[var(--primary-color)]">
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <div class="relative">
                    <input type="password" id="password" name="password" required
                        class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 shadow-sm focus:outline-none focus:ring-2 focus:ring-[var(--primary-color)] focus:border-[var(--primary-color)]">
                    <button type="button" id="togglePassword" class="absolute inset-y-0 right-3 flex items-center text-gray-500">
                        {{-- Eye --}}
                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm7.036.322a1.012 1.012 0 000-.644C20.573 7.51 16.64 4.5 12 4.5c-4.638 0-8.573 3.01-9.963 7.178a1.012 1.012 0 000 .644C3.427 16.49 7.36 19.5 12 19.5s8.573-3.01 10.036-7.178z" />
                        </svg>
                        {{-- Eye Slash --}}
                        <svg id="eyeSlashIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M3.98 8.223A10.451 10.451 0 001.934 12c1.29 4.338 5.309 7.5 10.066 7.5 1 0 1.957-.138 2.87-.395m6.228-3.333A10.522 10.522 0 0022.065 12c-1.292-4.337-5.31-7.5-10.066-7.5a10.45 10.45 0 00-5.772 1.728M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65" />
                        </svg>
                    </button>
                </div>
                <div class="text-right mt-2">
                    <a href="#" class="text-sm text-[var(--primary-color)] hover:underline">Lupa password?</a>
                </div>
            </div>

            {{-- Submit --}}
            <div class="mt-6">
                <button type="submit"
                    class="w-full bg-[var(--primary-color)] text-white py-2 px-4 rounded-md font-semibold hover:bg-green-800 transition">
                    Sign in
                </button>
            </div>

            {{-- Google Sign In
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">atau login dengan</p>
                <a href="#"
                   class="mt-3 inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 rounded-md shadow hover:scale-105 transition">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="w-5 h-5">
                    <span class="text-sm font-medium text-gray-700">Google</span>
                </a>
            </div> --}}
        </form>
    </div>

    {{-- Toggle Eye Script --}}
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        const eyeSlashIcon = document.getElementById('eyeSlashIcon');

        togglePassword.addEventListener('click', function () {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            eyeIcon.classList.toggle('hidden');
            eyeSlashIcon.classList.toggle('hidden');
        });
    </script>
</body>
</html>
