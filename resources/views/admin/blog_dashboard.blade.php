@extends('template.admin_dashboard_template')

@section('title', 'Dashboard')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Blog Terbaru</h1>

    {{-- Tombol Create Blog --}}
    <a href="/dashboard/blog/create" class="inline-block px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded-md shadow hover:bg-green-700 transition">
        + Buat Blog
    </a>
</div>

{{-- Card List Blog --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    {{-- Card 1 --}}
    <div class="bg-white rounded-lg shadow p-4">
        <img src="{{ asset('img/assets/blog-thumb-1.jpg') }}" alt="Blog Thumbnail" class="rounded-md mb-4 w-full h-40 object-cover">
        <h3 class="text-lg font-bold text-gray-800 mb-2">Judul Blog Pertama</h3>
        <p class="text-sm text-gray-600 mb-4">Ini adalah cuplikan konten blog yang menggambarkan isi artikel secara singkat...</p>
        <a href="#" class="text-indigo-600 text-sm hover:underline">Lihat Selengkapnya</a>
    </div>

    {{-- Card 2 --}}
    <div class="bg-white rounded-lg shadow p-4">
        <img src="{{ asset('img/assets/blog-thumb-2.jpg') }}" alt="Blog Thumbnail" class="rounded-md mb-4 w-full h-40 object-cover">
        <h3 class="text-lg font-bold text-gray-800 mb-2">Tips Menjadi Developer</h3>
        <p class="text-sm text-gray-600 mb-4">Beberapa tips dan trik untuk mengembangkan karier sebagai programmer pemula...</p>
        <a href="#" class="text-indigo-600 text-sm hover:underline">Lihat Selengkapnya</a>
    </div>

    {{-- Card 3 --}}
    <div class="bg-white rounded-lg shadow p-4">
        <img src="{{ asset('img/assets/blog-thumb-3.jpg') }}" alt="Blog Thumbnail" class="rounded-md mb-4 w-full h-40 object-cover">
        <h3 class="text-lg font-bold text-gray-800 mb-2">Headline Minggu Ini</h3>
        <p class="text-sm text-gray-600 mb-4">Berita utama dan tren teknologi yang sedang berkembang dalam sepekan terakhir...</p>
        <a href="#" class="text-indigo-600 text-sm hover:underline">Lihat Selengkapnya</a>
    </div>
</div>
@endsection
