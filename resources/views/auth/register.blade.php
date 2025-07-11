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
                        <input type="text" name="phone" id="phone" maxlength="15"
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
                               placeholder="Masukkan password" required>
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label for="password_confirmation" class="text-sm font-semibold text-gray-700">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="w-full py-2 border-b border-gray-300 text-lg focus:outline-none focus:border-green-600"
                               placeholder="Ulangi password" required>
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

{{-- Real-Time Validation Script --}}
<script>
document.addEventListener("DOMContentLoaded", function () {
    const fields = {
        username: {
            input: document.getElementById("username"),
            validate: val => val.length >= 3 || "Username minimal 3 karakter"
        },
        email: {
            input: document.getElementById("email"),
            validate: val => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val) || "Format email tidak valid"
        },
        phone: {
            input: document.getElementById("phone"),
            validate: val => /^(08|\+628)[0-9]{7,11}$/.test(val) || "Nomor harus mulai dari 08 atau +628 (10-13 digit)"
        },
        password: {
            input: document.getElementById("password"),
            validate: val => val.length >= 8 || "Password minimal 8 karakter"
        },
        password_confirmation: {
            input: document.getElementById("password_confirmation"),
            validate: val => val === document.getElementById("password").value || "Password tidak cocok"
        },
    };

    const showError = (input, message) => {
        clearError(input);
        const err = document.createElement("p");
        err.className = "text-sm text-red-600 mt-1 input-error";
        err.textContent = message;
        input.classList.add("border-red-500");
        input.parentNode.appendChild(err);
    };

    const clearError = (input) => {
        const err = input.parentNode.querySelector(".input-error");
        if (err) err.remove();
        input.classList.remove("border-red-500");
    };

    for (const key in fields) {
        const { input, validate } = fields[key];
        input.addEventListener("input", () => {
            const result = validate(input.value.trim());
            if (result !== true) {
                showError(input, result);
            } else {
                clearError(input);
            }
        });
    }
});
</script>

</body>
</html>
