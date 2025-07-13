@extends('template.admin_dashboard_template')

@section('title', 'Edit Blog')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-2">Edit Blog</h2>
        <p class="text-gray-500 text-sm">Perbarui informasi blog dan kontennya.</p>
    </div>

    <form action="{{ route('blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Judul --}}
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
            <input 
                type="text" 
                name="title" 
                id="title" 
                value="{{ old('title', $blog->title) }}"
                class="w-full px-3 py-2 rounded-md bg-white text-gray-800 border border-gray-300 focus:border-green-500 focus:ring-0 focus:outline-none"
                required>
        </div>

        {{-- Kategori --}}
        <div>
            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
            <select 
                name="category" 
                id="category"
                required
                class="w-full px-3 py-2 rounded-md bg-white text-gray-800 border border-gray-300 focus:border-green-500 focus:ring-0 focus:outline-none">
                <option value="">-- Pilih Kategori --</option>
                <option value="Teknologi" {{ $blog->category == 'Teknologi' ? 'selected' : '' }}>Teknologi</option>
                <option value="Budaya" {{ $blog->category == 'Budaya' ? 'selected' : '' }}>Budaya</option>
                <option value="Pendidikan" {{ $blog->category == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                <option value="Lingkungan" {{ $blog->category == 'Lingkungan' ? 'selected' : '' }}>Lingkungan</option>
            </select>
        </div>

        {{-- Thumbnail --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Thumbnail</label>
            <div class="flex items-start space-x-4">
                <div class="flex-1">
                    <input 
                        type="file" 
                        name="thumbnail" 
                        class="w-full text-sm file:mr-4 file:py-2 file:px-3 file:rounded-md file:border-0 file:bg-gray-100 hover:file:bg-gray-200 transition 
                        text-gray-700 border border-gray-300 rounded-md focus:ring-0 focus:border-green-500 focus:outline-none" />
                    <p class="text-sm text-gray-500 mt-2">Kosongkan jika tidak ingin mengganti thumbnail.</p>
                </div>
                <div class="w-32 shrink-0">
                    <img src="{{ asset('storage/' . $blog->thumbnail_path) }}" alt="Thumbnail" class="rounded-md w-full object-cover shadow-sm">
                </div>
            </div>
        </div>

        {{-- Konten --}}
        <div>
            <label for="summernote" class="block text-sm font-medium text-gray-700 mb-1">Konten</label>
            <textarea id="summernote" name="editordata" required class="hidden">{{ $blog->content }}</textarea>
        </div>

        {{-- Tombol --}}
        <div class="flex justify-end space-x-3 pt-4">
            <a href="{{ route('show-blog') }}" class="px-4 py-2 bg-gray-100 text-gray-800 rounded-md hover:bg-gray-200 transition text-sm">Batal</a>
            <button type="submit" class="px-5 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition text-sm shadow-sm">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['codeview']]
                ]
            });
        });
    </script>
@endsection
