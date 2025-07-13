@extends('template.admin_dashboard_template')

@section('title', 'Detail Blog')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $blog->title }}</h1>

    <img src="{{ asset('storage/' . $blog->thumbnail_path) }}" alt="Thumbnail" class="w-full h-64 object-cover rounded mb-6">

    <div class="prose max-w-full mb-6">
        {!! $content !!}
    </div>

    <div class="flex justify-between">
        <a href="{{ route('blog.edit', $blog->id) }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Edit Blog</a>

        <form action="{{ route('blog.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus blog ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                Hapus Blog
            </button>
        </form>
    </div>
</div>
@endsection
