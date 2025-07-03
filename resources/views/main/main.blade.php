@extends('template.main_template')

@section('title', 'Gayam-Gayamharjo')

@section('content')

{{-- Hero Section --}}
<section class="relative bg-cover bg-center h-[500px] flex items-center justify-center text-white text-center"
         style="background-image: url('{{ asset('img/gayamharjo-login-bg.png') }}');">
    <div class="absolute inset-0 bg-black/50"></div>
    <div class="relative z-10 p-8">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Explore Gayam</h1>
        <p class="mb-6">Start your journey and find unforgettable experiences wherever you go.</p>
        <a href="#" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-full">Get Started</a>
    </div>
</section>

{{-- Discover Section (Grid 4 kolom) --}}
<section class="py-16 text-center">
    <h2 class="text-3xl font-semibold mb-8">Discover Your Country</h2>
    <div class="grid md:grid-cols-4 gap-8 px-4 md:px-20">
        <div>
            <div class="text-4xl mb-4">🧳</div>
            <h3 class="font-bold text-lg mb-2">Talk With Us</h3>
            <p>We’re ready to help your adventure.</p>
        </div>
        <div>
            <div class="text-4xl mb-4">🗺️</div>
            <h3 class="font-bold text-lg mb-2">Choose a Guide</h3>
            <p>Pick experienced guides for your journey.</p>
        </div>
        <div>
            <div class="text-4xl mb-4">🚶</div>
            <h3 class="font-bold text-lg mb-2">Start Exploring</h3>
            <p>Find places you've never seen before.</p>
        </div>
        <div>
            <div class="text-4xl mb-4">🌟</div>
            <h3 class="font-bold text-lg mb-2">Rate Services</h3>
            <p>Give feedback to improve our trips.</p>
        </div>
    </div>
</section>

{{-- Discover Section (Gambar + fitur) --}}
<section class="py-16 bg-white">
    <div class="max-w-6xl mx-auto px-4 md:flex md:items-center md:gap-12">
        <div class="md:w-1/2 mb-10 md:mb-0">
            <img src="https://picsum.photos/seed/mountain/500/600"
                 alt="Mountains"
                 class="rounded-xl w-full object-cover shadow-lg">
        </div>
        <div class="md:w-1/2 grid grid-cols-1 sm:grid-cols-2 gap-8">
            <div class="text-center">
                <div class="w-12 h-12 mx-auto mb-4 bg-gray-200 rounded-full flex items-center justify-center text-2xl text-gray-700">
                    💬
                </div>
                <h3 class="font-bold text-lg mb-2">Talk With Us</h3>
                <p class="text-gray-600 text-sm">Our expert team is always available to help everyone find the right destination.</p>
            </div>
            <div class="text-center">
                <div class="w-12 h-12 mx-auto mb-4 bg-gray-200 rounded-full flex items-center justify-center text-2xl text-gray-700">
                    🧭
                </div>
                <h3 class="font-bold text-lg mb-2">Choose a Guide</h3>
                <p class="text-gray-600 text-sm">Our travel guides are locals and know the region perfectly.</p>
            </div>
            <div class="text-center">
                <div class="w-12 h-12 mx-auto mb-4 bg-gray-200 rounded-full flex items-center justify-center text-2xl text-gray-700">
                    🥾
                </div>
                <h3 class="font-bold text-lg mb-2">Start Exploring</h3>
                <p class="text-gray-600 text-sm">Strengthen your connection with culture and nature. Adventure follows those who start walking.</p>
            </div>
            <div class="text-center">
                <div class="w-12 h-12 mx-auto mb-4 bg-gray-200 rounded-full flex items-center justify-center text-2xl text-gray-700">
                    ✨
                </div>
                <h3 class="font-bold text-lg mb-2">Rate Services</h3>
                <p class="text-gray-600 text-sm">Manage your tours better with quality feedback from previous travelers.</p>
            </div>
        </div>
    </div>
</section>

{{-- Top Destinations --}}
<section class="bg-gray-100 py-16">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-semibold">Top Destinations</h2>
    </div>
    <div class="grid md:grid-cols-3 gap-6 px-4 md:px-20">
        @foreach (['Mountain', 'Beach', 'City Life'] as $dest)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="https://picsum.photos/seed/{{ strtolower($dest) }}/400/200" alt="{{ $dest }}" class="w-full h-40 object-cover">
                <div class="p-4">
                    <h3 class="font-bold text-xl mb-2">{{ $dest }}</h3>
                    <p class="text-gray-600 text-sm">Explore the amazing {{ strtolower($dest) }} destination now.</p>
                </div>
            </div>
        @endforeach
    </div>
</section>

{{-- Tentang Desa --}}
<section class="py-16 bg-white">
    <div class="max-w-5xl mx-auto text-center px-4">
        <h2 class="text-3xl font-semibold mb-4">Tentang Desa Kami</h2>
        <p class="text-gray-600 text-lg leading-relaxed">
            Desa Harmoni adalah desa yang kaya akan budaya, alam, dan kebersamaan warganya. Kami berkomitmen untuk membangun desa yang modern tanpa meninggalkan kearifan lokal.
        </p>
    </div>
</section>

{{-- Statistik Penduduk --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-6xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-semibold mb-12">Statistik Penduduk</h2>
        <div class="grid md:grid-cols-4 gap-8">
            <div>
                <p class="text-4xl font-bold text-blue-600">2,134</p>
                <p class="text-gray-700 mt-2">Total Penduduk</p>
            </div>
            <div>
                <p class="text-4xl font-bold text-green-600">1,092</p>
                <p class="text-gray-700 mt-2">Laki-Laki</p>
            </div>
            <div>
                <p class="text-4xl font-bold text-pink-500">1,042</p>
                <p class="text-gray-700 mt-2">Perempuan</p>
            </div>
            <div>
                <p class="text-4xl font-bold text-yellow-600">153</p>
                <p class="text-gray-700 mt-2">Lansia</p>
            </div>
        </div>
    </div>
</section>

{{-- Berita dan Pengumuman --}}
<section class="py-16">
    <div class="max-w-6xl mx-auto px-4">
        <h2 class="text-3xl font-semibold text-center mb-12">Berita & Pengumuman</h2>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach (['Pembangunan Jalan Baru', 'Pendaftaran BLT Tahap 2', 'Posyandu Balita dan Lansia'] as $news)
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-xl font-bold mb-2">{{ $news }}</h3>
                    <p class="text-gray-600 text-sm">Informasi terbaru seputar {{ strtolower($news) }} telah tersedia. Klik untuk membaca lebih lanjut.</p>
                    <a href="#" class="text-blue-600 mt-3 inline-block">Baca Selengkapnya →</a>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Kontak dan Lokasi --}}
<section class="py-20 bg-gray-100">
    <div class="max-w-5xl mx-auto px-4">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-semibold text-gray-800 mb-4">Hubungi Kami</h2>
            <p class="text-gray-600">Padukuhan Gayam</p>
            <p class="text-gray-600">Dusun Gayam, Desa Gayamharjo, Kecamatan Prambanan, Sleman, Yogyakarta</p>
            <p class="text-gray-600">
                Email: <a href="mailto:desaharmoni@example.com" class="text-blue-600 hover:underline">desaharmoni@example.com</a> |
                Telp: (021) 12345678
            </p>
        </div>

        {{-- Google Maps --}}
        <div class="relative w-full h-96 rounded-lg overflow-hidden shadow-lg">
            <iframe
                class="absolute top-0 left-0 w-full h-full border-0"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6577.738980944317!2d110.52720003561903!3d-7.808906053243921!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a4fddab6242e3%3A0xa4b4eb227b61f50c!2sGayam%2C%20Gayamharjo%2C%20Prambanan%2C%20Sleman%20Regency%2C%20Special%20Region%20of%20Yogyakarta!5e0!3m2!1sen!2sid!4v1750647892500!5m2!1sen!2sid"
                loading="lazy"
                allowfullscreen
                referrerpolicy="no-referrer-when-downgrade"
                style="filter: grayscale(100%) contrast(120%) opacity(90%); pointer-events: auto;">
            </iframe>
        </div>
    </div>
</section>


@endsection
