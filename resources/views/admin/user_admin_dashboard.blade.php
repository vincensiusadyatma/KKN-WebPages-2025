@extends('template.admin_dashboard_template')

@section('title', 'Dashboard - Manajemen Admin')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Manajemen Admin</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        {{-- Admin Card 1 --}}
        <a href="/dashboard/admin/1" class="group bg-white rounded-xl shadow hover:shadow-lg transition p-5 border border-gray-100 hover:border-indigo-400">
            <div class="flex items-center gap-4">
                <img src="https://ui-avatars.com/api/?name=Damar+Super" alt="Avatar" class="w-14 h-14 rounded-full">

                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900 group-hover:text-indigo-600">Damar Super</h3>
                    <p class="text-sm text-gray-500">superadmin@example.com</p>
                    
                    <div class="flex flex-wrap gap-2 mt-2">
                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 font-medium">Super Admin</span>
                        <span class="px-2 py-1 text-xs rounded-full bg-green-200 text-green-900 font-medium">Aktif</span>
                    </div>
                </div>
            </div>
        </a>

        {{-- Admin Card 2 --}}
        <a href="/dashboard/admin/2" class="group bg-white rounded-xl shadow hover:shadow-lg transition p-5 border border-gray-100 hover:border-indigo-400">
            <div class="flex items-center gap-4">
                <img src="https://ui-avatars.com/api/?name=Febi+Admin" alt="Avatar" class="w-14 h-14 rounded-full">

                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900 group-hover:text-indigo-600">Febi Admin</h3>
                    <p class="text-sm text-gray-500">febi@example.com</p>
                    
                    <div class="flex flex-wrap gap-2 mt-2">
                        <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 font-medium">Admin Biasa</span>
                        <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800 font-medium">Menunggu Persetujuan</span>
                    </div>
                </div>
            </div>
        </a>

        {{-- Admin Card 3 --}}
        <a href="/dashboard/admin/3" class="group bg-white rounded-xl shadow hover:shadow-lg transition p-5 border border-gray-100 hover:border-indigo-400">
            <div class="flex items-center gap-4">
                <img src="https://ui-avatars.com/api/?name=Rina+Admin" alt="Avatar" class="w-14 h-14 rounded-full">

                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900 group-hover:text-indigo-600">Rina Admin</h3>
                    <p class="text-sm text-gray-500">rina@example.com</p>
                    
                    <div class="flex flex-wrap gap-2 mt-2">
                        <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 font-medium">Admin Biasa</span>
                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800 font-medium">Ditolak</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
