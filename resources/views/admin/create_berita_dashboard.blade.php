@extends('template.admin_dashboard_template')

@section('title', 'Dashboard - Create Berita')

@section('content')
<div class="max-w-5xl mx-auto mt-8 px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6 border-b border-gray-200 pb-2">Buat Berita Baru</h2>

    <form action="#" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Judul Berita --}}
        <div>
            <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul Berita</label>
            <input type="text" name="judul" id="judul" required
                class="block w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition sm:text-sm" />
        </div>

        {{-- Gambar Thumbnail --}}
        <div>
            <label for="gambar" class="block text-sm font-medium text-gray-700 mb-1">Gambar Berita</label>
            <input type="file" name="gambar" id="gambar" accept="image/*"
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                file:rounded-lg file:border-0 file:text-sm file:font-semibold
                file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition" required>
        </div>

        {{-- Summernote Konten --}}
        <div>
            <label for="konten" class="block text-sm font-medium text-gray-700 mb-1">Isi Berita</label>
            <textarea id="summernote" name="konten"></textarea>
        </div>

        {{-- Tombol Submit --}}
        <div class="pt-4">
            <button type="submit"
                class="inline-flex items-center px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow transition">
                Simpan Berita
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Summernote Lite CSS/JS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script>
      $(document).ready(function() {
        $('#summernote').summernote({
          height: 250,
          placeholder: 'Tulis isi berita di sini...',
          toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['codeview']]
          ]
        });
      });
    </script>
@endsection
