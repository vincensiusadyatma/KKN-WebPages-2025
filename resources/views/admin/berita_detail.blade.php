@extends('template.admin_dashboard_template')

@section('title', 'Detail Berita')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $berita->title }}</h1>

    <img src="{{ asset('storage/' . $berita->thumbnail_path) }}" alt="Thumbnail" class="w-full h-64 object-cover rounded mb-6">

    <div class="prose max-w-full mb-6">
        {!! $content !!}
    </div>

    <div class="flex justify-between">
        <a href="{{ route('berita.edit', $berita->id) }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Edit Berita
        </a>

        <form action="{{ route('berita.destroy', $berita->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                Hapus Berita
            </button>
        </form>
    </div>
</div>
@endsection
