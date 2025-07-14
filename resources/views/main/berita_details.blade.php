@extends('template.main_template')

@section('title', $berita->title)

@section('content')
<section class="py-16 bg-gray-50 min-h-screen">
    <div class="max-w-3xl mx-auto px-4">
        {{-- Thumbnail --}}
        <div class="mb-6">
            <img src="{{ asset('storage/' . $berita->thumbnail_path) }}" alt="Thumbnail"
                 class="w-full h-64 object-cover rounded-lg shadow-md">
        </div>

        {{-- Judul dan Metadata --}}
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-2 leading-tight">{{ $berita->title }}</h1>
    <div class="flex items-center text-gray-500 text-sm gap-4 flex-wrap">
        <span>Dipublikasikan pada {{ $berita->created_at->format('d M Y') }}</span>

        {{-- Jumlah views --}}
        <div class="flex items-center gap-1 text-gray-600 bg-gray-100 px-3 py-1 rounded-full shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-lime-600" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 5C5 5 2 12 2 12s3 7 10 7 10-7 10-7-3-7-10-7zm0 12a5 5 0 1 1 0-10 5 5 0 0 1 0 10z"/>
                <circle cx="12" cy="12" r="2.5" fill="white"/>
            </svg>
            <span>{{ number_format($views) }} kali dilihat</span>
        </div>
    </div>
</div>


        {{-- Konten --}}
        <article class="prose max-w-none prose-img:rounded-lg prose-headings:text-gray-800 prose-p:text-gray-700 prose-a:text-lime-700">
            {!! $content !!}
        </article>

        {{-- Tombol kembali --}}
        <div class="mt-10">
            <a href="{{ route('berita.index') }}"
               class="inline-block px-5 py-2 bg-lime-600 text-white rounded hover:bg-lime-700 transition text-sm font-medium">
                ← Kembali ke daftar berita
            </a>
        </div>
    </div>
</section>
@endsection
