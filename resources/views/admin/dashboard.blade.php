@extends('template.admin_dashboard_template')

@section('title', 'Dashboard')

@section('content')
<div class="flex flex-col space-y-6 md:space-y-0 md:flex-row justify-between">
    <div class="mr-6">
        <h1 class="text-4xl font-semibold mb-2">Dashboard</h1>
        <h2 class="text-gray-600 ml-0.5">Panel Informasi Admin</h2>
    </div>
</div>

<!-- Statistik Ringkas -->
@php
    $stats = [
        ['title' => 'Jumlah Blog', 'value' => 12, 'color' => 'indigo'],
        ['title' => 'Jumlah Berita', 'value' => 8, 'color' => 'emerald'],
        ['title' => 'Konten oleh Anda', 'value' => 5, 'color' => 'amber'],
        ['title' => 'Jumlah Admin', 'value' => 3, 'color' => 'rose'],
    ];
@endphp

<section class="grid md:grid-cols-2 xl:grid-cols-4 gap-6 mt-8">
    @foreach ($stats as $stat)
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
            <div class="text-sm text-gray-500">{{ $stat['title'] }}</div>
            <div class="text-3xl font-bold text-{{ $stat['color'] }}-600 mt-2">{{ $stat['value'] }}</div>
        </div>
    @endforeach
</section>

<!-- Aktivitas & Progress -->
<section class="grid md:grid-cols-2 gap-6 mt-10">
    <!-- Aktivitas -->
    <div class="bg-white p-6 rounded-xl shadow-md">
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Aktivitas Akun Anda</h3>
        <ul class="space-y-3 text-sm text-gray-600">
            <li>🕒 Login terakhir: <strong>09 Juli 2025, 14:22 WIB</strong></li>
            <li>✍️ Konten terakhir dibuat: <strong>“Teknologi AI dan Masa Depan”</strong></li>
            <li>📂 Total konten Anda: <strong>5 post</strong></li>
            <li>🧑‍💼 Role: <strong>Admin</strong></li>
        </ul>
    </div>

<!-- Progress -->
<div class="bg-white p-6 rounded-xl shadow-md">
    <h3 class="text-xl font-semibold text-gray-700 mb-4">Statistik Konten Bulan Ini</h3>
    <div class="space-y-6">

        <!-- Blog -->
        <div>
            <div class="flex justify-between text-sm font-medium text-gray-600 mb-1">
                <span>Blog (6 konten)</span>
                <span class="text-indigo-600 font-semibold">60%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-3">
                <div class="bg-indigo-600 h-3 rounded-full" style="width: 60%"></div>
            </div>
        </div>

        <!-- Berita -->
        <div>
            <div class="flex justify-between text-sm font-medium text-gray-600 mb-1">
                <span>Berita (3 konten)</span>
                <span class="text-emerald-600 font-semibold">30%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-3">
                <div class="bg-emerald-500 h-3 rounded-full" style="width: 30%"></div>
            </div>
        </div>

        <!-- Total -->
        <div>
            <div class="flex justify-between text-sm font-medium text-gray-600 mb-1">
                <span>Total Konten (9 konten)</span>
                <span class="text-amber-600 font-semibold">100%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-3">
                <div class="bg-amber-500 h-3 rounded-full" style="width: 100%"></div>
            </div>
        </div>

    </div>
</div>


</section>

<!-- Tabel Konten Terbaru -->
<section class="mt-10 bg-white p-6 rounded-xl shadow-md">
    <h3 class="text-xl font-semibold text-gray-800 mb-6">📄 Konten Terbaru</h3>

    <ul class="divide-y divide-gray-200">
        @php
            $contents = [
                ['judul' => 'Teknologi AI dan Masa Depan', 'jenis' => 'Blog', 'tanggal' => '8 Juli 2025', 'status' => 'Dipublikasikan', 'warna' => 'green', 'ikon' => '📝'],
                ['judul' => 'Pengumuman Acara Kampus', 'jenis' => 'Berita', 'tanggal' => '6 Juli 2025', 'status' => 'Dipublikasikan', 'warna' => 'green', 'ikon' => '📢'],
                ['judul' => 'Tutorial Laravel 11', 'jenis' => 'Blog', 'tanggal' => '4 Juli 2025', 'status' => 'Draft', 'warna' => 'yellow', 'ikon' => '📝'],
                ['judul' => 'Tips Kuliah Produktif', 'jenis' => 'Blog', 'tanggal' => '2 Juli 2025', 'status' => 'Dipublikasikan', 'warna' => 'green', 'ikon' => '📝'],
                ['judul' => 'Update Sistem Absensi', 'jenis' => 'Berita', 'tanggal' => '30 Juni 2025', 'status' => 'Dihapus', 'warna' => 'red', 'ikon' => '📢'],
            ];
        @endphp

        @foreach ($contents as $item)
        <li class="flex items-center justify-between py-4 hover:bg-gray-50 px-2 rounded-md transition">
            <div class="flex items-center space-x-4">
                <div class="text-2xl">
                    {{ $item['ikon'] }}
                </div>
                <div>
                    <p class="text-base font-semibold text-gray-800">{{ $item['judul'] }}</p>
                    <p class="text-sm text-gray-500">
                        <span class="capitalize">{{ $item['jenis'] }}</span> ·
                        {{ $item['tanggal'] }}
                    </p>
                </div>
            </div>
            <div>
                <span class="px-3 py-1 text-xs font-medium rounded-full bg-{{ $item['warna'] }}-100 text-{{ $item['warna'] }}-800">
                    {{ $item['status'] }}
                </span>
            </div>
        </li>
        @endforeach
    </ul>
</section>


<!-- Footer -->
<section class="text-right font-semibold text-gray-500 mt-12">
    <a href="#" class="text-purple-600 hover:underline">All rights reserved gayamharjo 2025</a>
</section>
@endsection
