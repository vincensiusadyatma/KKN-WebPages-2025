@extends('template.main_template')

@section('title', 'Blog - Parangan Gayamharjo')

@section('content')
<section class="py-16 bg-gray-50">
    <div class="max-w-6xl mx-auto px-4">
        {{-- Header --}}
        <div class="mb-10 text-center">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Blog Desa Parangan</h1>
            <p class="text-gray-600 text-sm">Temukan artikel dan cerita terbaru dari desa kami.</p>
        </div>

        {{-- Form Pencarian --}}
        <form action="{{ route('blog.search') }}" method="GET"
              class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            
            {{-- Search Bar --}}
            <div class="relative w-full md:w-1/2">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari judul blog..."
                       class="w-full py-2 pl-4 pr-12 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-lime-400 focus:border-transparent transition">
                <button type="submit"
                        class="absolute right-2 top-1/2 -translate-y-1/2 bg-lime-600 hover:bg-lime-700 text-white px-3 py-1.5 rounded-full text-sm shadow-md transition">
                    Cari
                </button>
            </div>

            {{-- Dropdown Kategori --}}
            <div class="w-full md:w-60">
                <select name="category"
                        class="w-full py-2 px-4 rounded-full border border-gray-300 shadow-sm bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-lime-400 focus:border-transparent transition">
                    <option value="">-- Semua Kategori --</option>
                    <option value="Teknologi" {{ request('category') == 'Teknologi' ? 'selected' : '' }}>Teknologi</option>
                    <option value="Budaya" {{ request('category') == 'Budaya' ? 'selected' : '' }}>Budaya</option>
                    <option value="Pendidikan" {{ request('category') == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                    <option value="Lingkungan" {{ request('category') == 'Lingkungan' ? 'selected' : '' }}>Lingkungan</option>
                </select>
            </div>
        </form>

        {{-- Grid Blog --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($blogs as $blog)
                <div class="bg-white rounded-lg shadow p-4 flex flex-col justify-between h-full hover:shadow-lg transition">
                    <img src="{{ $blog->thumbnail_path }}" alt="Thumbnail"
                         class="w-full h-48 object-cover rounded mb-4">

                    <div class="text-xs text-gray-500 mb-2 flex justify-between items-center">
                        <span>{{ \Carbon\Carbon::parse($blog->created_at)->translatedFormat('d F Y') }}</span>
                        <span>Oleh: {{ optional($blog->authors->first())->username ?? 'Anonim' }}</span>
                    </div>

                    <h3 class="text-lg font-semibold text-gray-800 mb-2 hover:text-lime-600 transition">
                        {{ $blog->title }}
                    </h3>

                    <p class="text-sm text-gray-600 mb-4 leading-relaxed">
                        {{ $blog->preview }}
                    </p>

                    <a href="{{ route('blog.detail.main', $blog->id) }}"
                       class="mt-auto inline-block text-center px-4 py-2 bg-lime-600 text-white rounded-md text-sm font-medium hover:bg-lime-700 transition">
                        Baca Selengkapnya
                    </a>
                </div>
            @empty
                <div class="col-span-3 text-center text-gray-500 py-12">
                    Tidak ada blog yang ditemukan.
                </div>
            @endforelse
        </div>

        {{-- Custom Pagination --}}
        @if ($blogs->hasPages())
            <div class="mt-12 text-center">
                {{-- Tombol Previous dan Next --}}
                <div class="inline-flex space-x-4 mb-2">
                    @if ($blogs->onFirstPage())
                        <span class="px-4 py-2 bg-gray-200 text-gray-500 rounded cursor-not-allowed">Previous</span>
                    @else
                        <a href="{{ $blogs->previousPageUrl() }}"
                           class="px-4 py-2 bg-lime-600 text-white rounded hover:bg-lime-700 transition">Previous</a>
                    @endif

                    @if ($blogs->hasMorePages())
                        <a href="{{ $blogs->nextPageUrl() }}"
                           class="px-4 py-2 bg-lime-600 text-white rounded hover:bg-lime-700 transition">Next</a>
                    @else
                        <span class="px-4 py-2 bg-gray-200 text-gray-500 rounded cursor-not-allowed">Next</span>
                    @endif
                </div>

                {{-- Info Hasil --}}
                <div class="text-sm text-gray-600 mt-1">
                    Menampilkan {{ $blogs->firstItem() }} - {{ $blogs->lastItem() }} dari total {{ $blogs->total() }} blog
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
