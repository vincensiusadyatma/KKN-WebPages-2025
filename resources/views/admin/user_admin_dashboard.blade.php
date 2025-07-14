@extends('template.admin_dashboard_template')

@section('title', 'Dashboard - Manajemen Admin')

@section('content')

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Manajemen Admin</h1>


    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
         @foreach ($list_users as $admin)
              <a href="{{ route('show-admin-detail', $admin->id) }}" class="group bg-white rounded-xl shadow hover:shadow-lg transition p-5 border border-gray-100 hover:border-indigo-400">
            <div class="flex items-center gap-4">
                <img src="{{ asset('img/profile1.png') }}" alt="Avatar" class="w-14 h-14 rounded-full">

                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900 group-hover:text-indigo-600">{{ $admin->username }}</h3>
                    <p class="text-sm text-gray-500">{{ $admin->email }}</p>
                    
                   <div class="flex flex-wrap gap-2 mt-2">
    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 font-medium">
        {{ $admin->roles->first()?->name }}
    </span>

    @php
        $statusColor = match($admin->status) {
            'active' => 'bg-green-200 text-green-900',
            'decline' => 'bg-red-200 text-red-900',
            default => 'bg-yellow-200 text-yellow-900', // termasuk 'pending'
        };
    @endphp
    <span class="px-2 py-1 text-xs rounded-full font-medium {{ $statusColor }}">
        {{ ucfirst($admin->status) }}
    </span>
</div>

                </div>
            </div>
        </a>

        @endforeach
        {{-- Admin Card 1 --}}
      
       
    </div>
</div>
@endsection
