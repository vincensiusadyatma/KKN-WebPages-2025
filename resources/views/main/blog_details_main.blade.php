@extends('template.main_template')

@section('title', $blog->title)

@section('content')
<section class="py-16 bg-gray-50 min-h-screen">
    <div class="max-w-3xl mx-auto px-4">
        {{-- Thumbnail --}}
        <div class="mb-6">
            <img src="{{ $blog->thumbnail_url }}" alt="Thumbnail"
                 class="w-full h-64 object-cover rounded-lg shadow-md">
        </div>

        {{-- Judul dan Metadata --}}
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-2 leading-tight">{{ $blog->title }}</h1>
            <p class="text-gray-500 text-sm">Dipublikasikan pada {{ $blog->created_at->format('d M Y') }}</p>
        </div>

        {{-- Konten --}}
        <article class="prose max-w-none prose-img:rounded-lg prose-headings:text-gray-800 prose-p:text-gray-700 prose-a:text-lime-700">
            {!! $content !!}
        </article>

        {{-- Tombol kembali --}}
        <div class="mt-10">
            <a href="{{ route('blog.index') }}"
               class="inline-block px-5 py-2 bg-lime-600 text-white rounded hover:bg-lime-700 transition text-sm font-medium">
                ← Kembali ke daftar blog
            </a>
        </div>
    </div>
</section>
@endsection
