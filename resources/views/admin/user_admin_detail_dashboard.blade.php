@extends('template.admin_dashboard_template')

@section('title', 'Dashboard - Manajemen Admin')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg mt-8">
    @php
        $statusColor = match($user->status) {
            'active' => 'bg-green-100 text-green-700',
            'decline' => 'bg-red-100 text-red-700',
            default => 'bg-yellow-100 text-yellow-700', // pending atau lainnya
        };
    @endphp

    <!-- Profile -->
    <div class="flex items-center space-x-6">
        <img src="{{ asset('img/profile1.png') }}" alt="Foto Admin"
             class="w-24 h-24 rounded-full object-cover border border-gray-300">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">{{ $user->username }}</h2>
            <p class="text-sm text-gray-500">{{ $user->email }}</p>
            <span class="inline-block mt-2 px-3 py-1 text-sm rounded-full {{ $statusColor }}">
                {{ ucfirst($user->status) }}
            </span>
        </div>
    </div>

    <!-- Detail -->
    <div class="mt-6 space-y-4">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-500">Nomor Telepon</p>
                <p class="font-medium text-gray-700">{{ $user->phone_number }}</p>
            </div>
        </div>

        <div>
            <p class="text-sm text-gray-500">Peran</p>
            <div class="flex flex-wrap gap-2 mt-1">
                <span class="px-3 py-1 bg-purple-100 text-purple-700 text-xs rounded-full">
                    {{ $user->roles->first()?->name }}
                </span>
            </div>
        </div>

        <!-- Tombol Aksi Status -->
        <div class="mt-6 text-right">
            @if ($user->status === 'pending')
                <!-- Beri Izin -->
                <form action="{{ route('change-admin-status', $user->email) }}" method="POST" class="inline-block">
                    @csrf
                    <input type="hidden" name="status" value="active">
                    <button type="submit"
                            class="px-5 py-2 bg-green-600 text-white text-sm font-semibold rounded-md hover:bg-green-700 transition">
                        Beri Izin
                    </button>
                </form>

                <!-- Tolak Beri Izin -->
                <form action="{{ route('change-admin-status', $user->email) }}" method="POST" class="inline-block ml-3">
                    @csrf
                    <input type="hidden" name="status" value="decline">
                    <button type="submit"
                            class="px-5 py-2 bg-red-600 text-white text-sm font-semibold rounded-md hover:bg-red-700 transition">
                        Tolak Beri Izin
                    </button>
                </form>

            @elseif ($user->status === 'active')
                <!-- Hapus Izin -->
                <form action="{{ route('change-admin-status', $user->email) }}" method="POST" class="inline-block">
                    @csrf
                    <input type="hidden" name="status" value="decline">
                    <button type="submit"
                            class="px-5 py-2 bg-red-600 text-white text-sm font-semibold rounded-md hover:bg-red-700 transition">
                        Hapus Izin
                    </button>
                </form>

            @elseif ($user->status === 'decline')
                <!-- Beri Izin -->
                <form action="{{ route('change-admin-status', $user->email) }}" method="POST" class="inline-block">
                    @csrf
                    <input type="hidden" name="status" value="active">
                    <button type="submit"
                            class="px-5 py-2 bg-green-600 text-white text-sm font-semibold rounded-md hover:bg-green-700 transition">
                        Beri Izin
                    </button>
                </form>
            @endif
            <!-- Tombol Hapus Akun -->
<form action="{{ route('delete-admin', $user->id) }}" method="POST" class="inline-block ml-3"
      onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini?');">
    @csrf
    @method('DELETE')
    <button type="submit"
            class="px-5 py-2 bg-gray-700 text-white text-sm font-semibold rounded-md hover:bg-gray-800 transition">
        Hapus Akun
    </button>
</form>

        </div>
    </div>
</div>
@endsection
