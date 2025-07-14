@extends('template.main_template')

@section('title', 'Berita - Parangan Gayamharjo')

@section('content')
<section class="py-16 bg-gray-50">
    <div class="max-w-6xl mx-auto px-4">
        <div class="mb-10 text-center">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Berita Desa Parangan</h1>
            <p class="text-gray-600 text-sm">Update informasi terkini dari desa kami.</p>
        </div>

        @if (request('search') || request('category'))
            <div class="mb-4 text-center text-sm text-gray-600">
                Menampilkan hasil
                @if(request('search')) pencarian untuk: <strong>"{{ request('search') }}"</strong>@endif
                @if(request('category'))
                    {{ request('search') ? ' dan ' : '' }}
                    kategori: <strong>{{ request('category') }}</strong>
                @endif
            </div>
        @endif

        {{-- Form Pencarian --}}
        <form action="{{ route('berita.search') }}" method="GET"
              class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div class="relative w-full md:w-1/2">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari judul berita..."
                       class="w-full py-2 pl-4 pr-12 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-lime-400 focus:border-transparent transition">
                <button type="submit"
                        class="absolute right-2 top-1/2 -translate-y-1/2 bg-lime-600 hover:bg-lime-700 text-white px-3 py-1.5 rounded-full text-sm shadow-md transition">
                    Cari
                </button>
            </div>

            <div class="w-full md:w-60">
                <select name="category"
                        class="w-full py-2 px-4 rounded-full border border-gray-300 shadow-sm bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-lime-400 focus:border-transparent transition">
                    <option value="">-- Semua Kategori --</option>
                    <option value="Teknologi" {{ request('category') == 'Teknologi' ? 'selected' : '' }}>Teknologi</option>
                    <option value="Budaya" {{ request('category') == 'Budaya' ? 'selected' : '' }}>Budaya</option>
                    <option value="Pendidikan" {{ request('category') == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                    <option value="Lingkungan" {{ request('category') == 'Lingkungan' ? 'selected' : '' }}>Lingkungan</option>
                    <option value="Kesehatan" {{ request('category') == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                    <option value="Kegiatan" {{ request('category') == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                </select>
            </div>
        </form>

        {{-- Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($beritas as $berita)
                <div class="bg-white rounded-lg shadow p-4 flex flex-col justify-between h-full hover:shadow-lg transition">
                    <img src="{{ $berita->thumbnail_path }}" alt="Thumbnail"
                         class="w-full h-48 object-cover rounded mb-4">

                    <span class="inline-block mb-2 bg-lime-100 text-lime-800 text-xs font-semibold px-3 py-1 rounded-full w-fit">
                        {{ $berita->category ?? 'Umum' }}
                    </span>

                    <div class="text-xs text-gray-500 mb-2 flex justify-between items-center">
                        <span>{{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('d F Y') }}</span>
                        <span>Oleh: {{ optional($berita->authors->first())->username ?? 'Anonim' }}</span>
                    </div>

                    <h3 class="text-lg font-semibold text-gray-800 mb-2 hover:text-lime-600 transition">
                        {{ $berita->title }}
                    </h3>

                    <p class="text-sm text-gray-600 mb-4 leading-relaxed">
                        {{ $berita->preview }}
                    </p>

                    <a href="{{ route('berita.detail.main', $berita->id) }}"
                       class="mt-auto inline-block text-center px-4 py-2 bg-lime-600 text-white rounded-md text-sm font-medium hover:bg-lime-700 transition">
                        Baca Selengkapnya
                    </a>
                </div>
            @empty
                <div class="col-span-3 text-center text-gray-500 py-12">
                    Tidak ada berita yang ditemukan.
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if ($beritas->hasPages())
            <div class="mt-12 text-center">
                <div class="inline-flex space-x-4 mb-2">
                    @if ($beritas->onFirstPage())
                        <span class="px-4 py-2 bg-gray-200 text-gray-500 rounded cursor-not-allowed">Previous</span>
                    @else
                        <a href="{{ $beritas->previousPageUrl() }}"
                           class="px-4 py-2 bg-lime-600 text-white rounded hover:bg-lime-700 transition">Previous</a>
                    @endif

                    @if ($beritas->hasMorePages())
                        <a href="{{ $beritas->nextPageUrl() }}"
                           class="px-4 py-2 bg-lime-600 text-white rounded hover:bg-lime-700 transition">Next</a>
                    @else
                        <span class="px-4 py-2 bg-gray-200 text-gray-500 rounded cursor-not-allowed">Next</span>
                    @endif
                </div>

                <div class="text-sm text-gray-600 mt-1">
                    Menampilkan {{ $beritas->firstItem() }} - {{ $beritas->lastItem() }} dari total {{ $beritas->total() }} berita
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
