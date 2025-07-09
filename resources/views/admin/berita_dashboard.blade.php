@extends('template.admin_dashboard_template')

@section('title', 'Dashboard - Berita Terbaru')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Berita Terbaru</h1>

    {{-- Tombol Create Berita --}}
    <a href="/dashboard/berita/create" class="inline-block px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md shadow hover:bg-blue-700 transition">
        + Buat Berita
    </a>
</div>

{{-- Card List Berita (Static) --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    {{-- Card 1 --}}
    <div class="bg-white rounded-lg shadow p-4">
        <img src="{{ asset('img/assets/berita-thumb-1.jpg') }}" alt="Berita Thumbnail" class="rounded-md mb-4 w-full h-40 object-cover">
        <h3 class="text-lg font-bold text-gray-800 mb-2">Kegiatan Sosial di Dusun</h3>
        <p class="text-sm text-gray-600 mb-4">Warga bersama mahasiswa KKN melakukan kegiatan bersih desa dan pembagian sembako...</p>
        <a href="#" class="text-indigo-600 text-sm hover:underline">Lihat Selengkapnya</a>
    </div>

    {{-- Card 2 --}}
    <div class="bg-white rounded-lg shadow p-4">
        <img src="{{ asset('img/assets/berita-thumb-2.jpg') }}" alt="Berita Thumbnail" class="rounded-md mb-4 w-full h-40 object-cover">
        <h3 class="text-lg font-bold text-gray-800 mb-2">Perbaikan Jalan Dusun</h3>
        <p class="text-sm text-gray-600 mb-4">Pemerintah desa bersama warga memperbaiki jalan rusak di RT 03 untuk kelancaran akses warga...</p>
        <a href="#" class="text-indigo-600 text-sm hover:underline">Lihat Selengkapnya</a>
    </div>

    {{-- Card 3 --}}
    <div class="bg-white rounded-lg shadow p-4">
        <img src="{{ asset('img/assets/berita-thumb-3.jpg') }}" alt="Berita Thumbnail" class="rounded-md mb-4 w-full h-40 object-cover">
        <h3 class="text-lg font-bold text-gray-800 mb-2">Lomba 17 Agustus Akan Digelar</h3>
        <p class="text-sm text-gray-600 mb-4">Panitia dusun telah menyiapkan berbagai lomba menarik untuk merayakan HUT RI ke-79...</p>
        <a href="#" class="text-indigo-600 text-sm hover:underline">Lihat Selengkapnya</a>
    </div>
</div>
@endsection
