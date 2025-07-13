@extends('template.admin_dashboard_template')

@section('title', 'Settings')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow-md space-y-6">
    <h2 class="text-2xl font-bold text-gray-800">Pengaturan Akun</h2>

    <form method="POST" action="{{ route('settings.update') }}" class="space-y-6">
        @csrf

        <!-- Nama -->
        <div>
            <label class="block text-sm text-gray-600">Nama</label>
            <input type="text" name="username" value="{{ old('username', auth()->user()->username) }}"
                   class="w-full mt-1 px-4 py-2 border rounded-md focus:ring focus:ring-purple-300" required>
            @error('username') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Email -->
        <div>
            <label class="block text-sm text-gray-600">Email</label>
            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                   class="w-full mt-1 px-4 py-2 border rounded-md focus:ring focus:ring-purple-300" required>
            @error('email') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Password Baru (Opsional) -->
        <div>
            <label class="block text-sm text-gray-600">Password Baru (opsional)</label>
            <input type="password" name="new_password"
                   class="w-full mt-1 px-4 py-2 border rounded-md focus:ring focus:ring-purple-300">
            @error('new_password') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 transition">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
