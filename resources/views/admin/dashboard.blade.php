@extends('template.admin_dashboard_template')

@section('title', 'Dashboard')

@section('content')
<div class="flex flex-col space-y-6 md:space-y-0 md:flex-row justify-between">
    <div class="mr-6">
        <h1 class="text-4xl font-semibold mb-2">Dashboard</h1>
        <h2 class="text-gray-600 ml-0.5">Panel Informasi Admin</h2>
    </div>
</div>

@php
    $stats = [
        ['title' => 'Jumlah Blog', 'value' => $jumlahBlog, 'color' => 'indigo'],
        ['title' => 'Jumlah Berita', 'value' => $jumlahBerita, 'color' => 'emerald'],
        ['title' => 'Konten oleh Anda', 'value' => $dibuatOlehSaya, 'color' => 'amber'],
        ['title' => 'Jumlah Admin', 'value' => $jumlahAdmin, 'color' => 'rose'],
        ['title' => 'Total Pengunjung', 'value' => $totalVisitors, 'color' => 'sky'],
    ];
@endphp

<!-- Statistik Ringkas -->
<section class="grid md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-5 gap-6 mt-8">
    @foreach ($stats as $stat)
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
            <div class="text-sm text-gray-500">{{ $stat['title'] }}</div>
            <div class="text-3xl font-bold text-{{ $stat['color'] }}-600 mt-2">
                {{ number_format($stat['value']) }}
            </div>
        </div>
    @endforeach
</section>

<!-- Aktivitas & Progress -->
<section class="grid md:grid-cols-2 gap-6 mt-10">
    <!-- Aktivitas -->
    <div class="bg-white p-6 rounded-xl shadow-md">
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Aktivitas Akun Anda</h3>
        <ul class="space-y-3 text-sm text-gray-600">
            <li>🕒 Login terakhir: <strong>{{ now()->format('d M Y, H:i') }} WIB</strong></li>
            <li>✍️ Konten terakhir dibuat: 
                <strong>{{ $blogs->first()?->title ?? 'Belum ada konten' }}</strong>
            </li>
            <li>📂 Total konten Anda: <strong>{{ $dibuatOlehSaya }} post</strong></li>
            <li>🧑‍💼 Role: 
                <strong>{{ implode(', ', $user->roles->pluck('name')->toArray()) }}</strong>
            </li>
        </ul>
    </div>

    <!-- Progress -->
    <div class="bg-white p-6 rounded-xl shadow-md">
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Statistik Konten Bulan Ini</h3>

        @php
            $totalKonten = $jumlahBlog + $jumlahBerita;
            $persenBlog = $totalKonten > 0 ? round(($jumlahBlog / $totalKonten) * 100) : 0;
            $persenBerita = $totalKonten > 0 ? round(($jumlahBerita / $totalKonten) * 100) : 0;
        @endphp

        <div class="space-y-6">
            <!-- Blog -->
            <div>
                <div class="flex justify-between text-sm font-medium text-gray-600 mb-1">
                    <span>Blog ({{ $jumlahBlog }} konten)</span>
                    <span class="text-indigo-600 font-semibold">{{ $persenBlog }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                    <div class="bg-indigo-600 h-3 rounded-full transition-all duration-300" style="width: {{ $persenBlog }}%"></div>
                </div>
            </div>

            <!-- Berita -->
            <div>
                <div class="flex justify-between text-sm font-medium text-gray-600 mb-1">
                    <span>Berita ({{ $jumlahBerita }} konten)</span>
                    <span class="text-emerald-600 font-semibold">{{ $persenBerita }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                    <div class="bg-emerald-500 h-3 rounded-full transition-all duration-300" style="width: {{ $persenBerita }}%"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Konten Blog Terbaru -->
<section class="mt-10 bg-white p-6 rounded-xl shadow-md">
    <h3 class="text-xl font-semibold text-gray-800 mb-6">📄 Konten Blog Terbaru</h3>

    <table class="min-w-full divide-y divide-gray-200 text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="text-left px-4 py-2 font-medium text-gray-600">Judul</th>
                <th class="text-left px-4 py-2 font-medium text-gray-600">Tanggal</th>
                <th class="text-left px-4 py-2 font-medium text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($blogs as $blog)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-gray-800 font-medium">{{ $blog->title }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $blog->created_at->format('d M Y') }}</td>
                    <td class="px-4 py-3 space-x-2">
                        <a href="{{ route('blog.detail', $blog->id) }}" class="text-indigo-600 hover:underline">Lihat</a>
                        <a href="{{ route('blog.edit', $blog->id) }}" class="text-green-600 hover:underline">Edit</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center py-6 text-gray-500">Belum ada blog yang dipublikasikan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</section>

<!-- Konten Berita Terbaru -->
<section class="mt-10 bg-white p-6 rounded-xl shadow-md">
    <h3 class="text-xl font-semibold text-gray-800 mb-6">📰 Konten Berita Terbaru</h3>

    <table class="min-w-full divide-y divide-gray-200 text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="text-left px-4 py-2 font-medium text-gray-600">Judul</th>
                <th class="text-left px-4 py-2 font-medium text-gray-600">Tanggal</th>
                <th class="text-left px-4 py-2 font-medium text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($beritas as $berita)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-gray-800 font-medium">{{ $berita->title }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $berita->created_at->format('d M Y') }}</td>
                    <td class="px-4 py-3 space-x-2">
                        <a href="{{ route('berita.detail', $berita->id) }}" class="text-indigo-600 hover:underline">Lihat</a>
                        <a href="{{ route('berita.edit', $berita->id) }}" class="text-green-600 hover:underline">Edit</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center py-6 text-gray-500">Belum ada berita yang dipublikasikan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</section>
@endsection
