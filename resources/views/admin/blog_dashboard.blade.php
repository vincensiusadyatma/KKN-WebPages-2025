@extends('template.admin_dashboard_template')

@section('title', 'Dashboard')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Blog Terbaru</h1>
    <a href="/dashboard/blog/create" class="inline-block px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded-md shadow hover:bg-green-700 transition">
        + Buat Blog
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($blogs as $blog)
    <div class="bg-white rounded-lg shadow p-4 mb-6 flex flex-col justify-between h-full">
        <img src="{{ $blog->thumbnail_path }}" alt="Thumbnail" class="w-full h-48 object-cover rounded mb-4">
        
        <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $blog->title }}</h3>

        @php
            $allowedTags = '<b><i><u><strong><em>';
            $lines = preg_split('/(\r\n|\r|\n)/', strip_tags($blog->preview ?? '', $allowedTags));
            $lines = array_filter(array_map('trim', $lines));
            $displayed = array_slice($lines, 0, 2); // Ambil 2 baris saja
            $isTrimmed = count($lines) > 2 || str_ends_with(trim($blog->preview), '...');
        @endphp

        <div class="text-sm text-gray-600 leading-relaxed break-words">
            @foreach ($displayed as $line)
                <p class="mb-2">{!! $line !!}</p>
            @endforeach

            @if ($isTrimmed)
                <p class="text-gray-500">...</p>
            @endif
        </div>

        {{-- Tombol View Details --}}
        <a href="{{ route('blog.detail', ['id' => $blog->id]) }}" 
           class="mt-4 inline-block text-center px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-medium hover:bg-indigo-700 transition">
            View Details
        </a>
    </div>
    @endforeach
</div>
@endsection
