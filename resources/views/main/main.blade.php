@extends('template.main_template')

@section('title', 'Parangan-Gayamharjo')

@section('content')

{{-- Hero Section --}}
<section class="relative bg-cover bg-center h-[500px] flex items-center justify-center text-white text-center"
         style="background-image: url('{{ asset('img/gayamharjo-login-bg.png') }}');">
    <div class="absolute inset-0 bg-black/50"></div>
    <div class="relative z-10 p-8">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Explore Parangan</h1>
        <p class="mb-6">Sebuah dusun kecil di Prambanan yang menyimpan kehangatan, keindahan, dan keramahan Jogja</p>
        <a href="#" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-full">Get Started</a>
    </div>
</section>

{{-- Discovery Dusun --}}
<section class="py-16 text-center bg-gray-50">
    <h2 class="text-3xl font-bold mb-8 text-gray-800">Discovery Dusun</h2>
    <div class="grid md:grid-cols-4 gap-8 px-4 md:px-20">
        {{-- Cuaca --}}
        <div class="bg-white rounded-xl shadow-lg p-6 hover:-translate-y-1 hover:shadow-2xl transition-all duration-300">
            <div class="text-5xl mb-4 text-lime-500">🌤️</div>
            <h3 class="font-bold text-lg mb-2">Cuaca Hari Ini</h3>
            <p id="cuaca" class="text-gray-600 text-sm">Memuat data cuaca...</p>
            <p class="mt-2 text-xs text-gray-500">Pantauan cuaca real-time untuk aktivitas harian warga dan wisatawan.</p>
        </div>

        {{-- Suhu --}}
        <div class="bg-white rounded-xl shadow-lg p-6 hover:-translate-y-1 hover:shadow-2xl transition-all duration-300">
            <div class="text-5xl mb-4 text-orange-500">🌡️</div>
            <h3 class="font-bold text-lg mb-2">Suhu Udara</h3>
            <p id="suhu" class="text-gray-600 text-sm">Memuat suhu...</p>
            <p class="mt-2 text-xs text-gray-500">Informasi suhu udara terkini untuk kenyamanan aktivitas luar ruangan.</p>
        </div>

        {{-- Lokasi --}}
        <div class="bg-white rounded-xl shadow-lg p-6 hover:-translate-y-1 hover:shadow-2xl transition-all duration-300">
            <div class="text-5xl mb-4 text-blue-500">📍</div>
            <h3 class="font-bold text-lg mb-2">Lokasi Wilayah</h3>
            <p class="text-gray-600 text-sm">Prambanan, Yogyakarta</p>
            <p class="mt-2 text-xs text-gray-500">Dusun Parangan berada di Prambanan, Sleman — dikenal dengan situs sejarah dan keramahan warga.</p>
        </div>

        {{-- Padukuhan --}}
        <div class="bg-white rounded-xl shadow-lg p-6 hover:-translate-y-1 hover:shadow-2xl transition-all duration-300">
            <div class="text-5xl mb-4 text-purple-500">🏘️</div>
            <h3 class="font-bold text-lg mb-2">Padukuhan</h3>
            <p class="text-gray-600 text-sm">Gayam</p>
            <p class="mt-2 text-xs text-gray-500">Padukuhan Gayam terkenal dengan suasana asri, gotong royong, dan wisata budaya.</p>
        </div>
    </div>
</section>

{{-- Discover Section (Fasilitas Dusun) --}}
<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4 md:flex md:items-center md:gap-12">
        {{-- Gambar --}}
        <div class="md:w-1/2 mb-10 md:mb-0 relative group">
            <img src="{{ asset('img/gang_dusun_parangan.jpg') }}" class="rounded-2xl w-full object-cover shadow-xl group-hover:scale-105 transition duration-500">
            <div class="absolute bottom-4 left-4 bg-black/60 text-white text-xs px-3 py-1 rounded">
                Jalan utama menuju pusat dusun yang rapi dan asri.
            </div>
        </div>

        {{-- Fitur --}}
        <div class="md:w-1/2 grid grid-cols-1 sm:grid-cols-2 gap-8">
            @foreach ([
                ['icon' => '🏞️', 'title' => 'Dekat Tempat Wisata', 'desc' => 'Lokasi strategis dekat Candi Ratu Boko dan Tebing Breksi.'],
                ['icon' => '🕌', 'title' => 'Masjid Dusun', 'desc' => 'Tempat ibadah dan pengajian warga.'],
                ['icon' => '👶', 'title' => 'Posyandu', 'desc' => 'Pelayanan kesehatan untuk balita dan lansia.'],
                ['icon' => '🛡️', 'title' => '3 Pos Ronda', 'desc' => 'Menjaga keamanan lingkungan secara bergiliran.'],
            ] as $fasilitas)
                <div class="text-center">
                    <div class="w-14 h-14 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center text-2xl">
                        {{ $fasilitas['icon'] }}
                    </div>
                    <h3 class="font-bold text-lg mb-2">{{ $fasilitas['title'] }}</h3>
                    <p class="text-gray-600 text-sm">{{ $fasilitas['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Tentang Desa --}}
<section class="py-16 bg-white" id="about">
    <div class="max-w-5xl mx-auto text-center px-4">
        <h2 class="text-3xl font-semibold mb-4 text-gray-800">Tentang Dusun Parangan</h2>
        <p class="text-gray-600 text-lg leading-relaxed">
            Dusun Parangan adalah dusun di Desa Gayamharjo, Padukuhan Gayam, Prambanan, Sleman. Dikenal karena suasana pedesaan yang damai dan gotong royong warga. Dekat juga dengan tempat wisata seperti Obelix Hills dan Goa Maria Sendang Sriningsih.
        </p>
    </div>
</section>

{{-- Top Destinations --}}
<section class="bg-gray-100 py-16">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-semibold text-gray-800">Top Destinations</h2>
         <p class="text-gray-600 mt-2 text-sm md:text-base">Wisata sekitar Dusun Parangan, Gayamharjo</p>
    </div>
    </div>
    <div class="grid md:grid-cols-3 gap-6 px-4 md:px-20">
        <!-- Obelix Hills -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
            <img src="{{ asset('img/obelix-hills.png') }}" alt="Obelix Hills" class="w-full h-60 object-cover">
            <div class="p-5">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Obelix Hills</h3>
                <p class="text-sm text-gray-600">
                    Destinasi wisata populer di Yogyakarta yang menawarkan panorama sunset menakjubkan, spot foto estetik, dan suasana santai di atas bukit.
                </p>
            </div>
        </div>

        <!-- Tebing Breksi -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
            <img src="{{ asset('img/tebing_breksi.jpg') }}" alt="Tebing Breksi" class="w-full h-60 object-cover">
            <div class="p-5">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Tebing Breksi</h3>
                <p class="text-sm text-gray-600">
                    Situs bekas tambang kapur yang diubah menjadi tempat wisata unik dengan pahatan seni di tebing dan pemandangan kota Yogyakarta dari ketinggian.
                </p>
            </div>
        </div>

        <!-- Gua Maria Sendang Sriningsih -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
            <img src="{{ asset('img/guamariasendangsriningsih.jpeg') }}" alt="Gua Maria Sendang Sriningsih" class="w-full h-60 object-cover">
            <div class="p-5">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Gua Maria Sendang Sriningsih</h3>
                <p class="text-sm text-gray-600">
                    Tempat ziarah Katolik yang tenang dan sejuk, terletak di kawasan pegunungan dengan suasana hening yang cocok untuk berdoa dan refleksi diri.
                </p>
            </div>
        </div>
    </div>
</section>


<section class="py-16 bg-gray-50 font-inter antialiased">
    <div class="max-w-6xl mx-auto px-4">
        <h2 class="text-3xl font-semibold text-center mb-12">Berita Terbaru</h2>

        <!-- Slider Berita Otomatis -->
        <div
            x-data="{}"
            x-init="$nextTick(() => {
                let ul = $refs.berita;
                ul.insertAdjacentHTML('afterend', ul.outerHTML);
                ul.nextSibling.setAttribute('aria-hidden', 'true');
            })"
            class="w-full inline-flex flex-nowrap overflow-hidden [mask-image:_linear-gradient(to_right,transparent_0,_black_128px,_black_calc(100%-128px),transparent_100%)]"
        >
         <ul x-ref="berita" class="flex items-center gap-6 animate-infinite-scroll px-2">

                @foreach ($berita as $item)
                    <li class="flex-shrink-0 w-80">
                        <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition overflow-hidden">
                            <a href="#">
                                <img src="{{ $item->thumbnail_url }}" class="w-full h-44 object-cover" />
                                <div class="p-4">
                                    <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $item->title }}</h3>
                                    <p class="text-gray-600 text-sm">
                                        {{ $item->preview ?? Str::limit(strip_tags($item->content ?? ''), 80) }}
                                    </p>
                                    <p class="text-xs text-gray-400 mt-2">{{ $item->created_at->format('d M Y') }}</p>
                                </div>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Tombol Lihat Selengkapnya -->
        <div class="text-center mt-8">
            <a href="{{ route('berita.index') }}" class="bg-lime-600 text-white px-6 py-2 rounded hover:bg-lime-700 transition font-medium">
                Lihat Selengkapnya →
            </a>
        </div>
    </div>
</section>


<section class="py-16 bg-gray-50 font-inter antialiased">
    <div class="max-w-6xl mx-auto px-4">
        <h2 class="text-3xl font-semibold text-center mb-12">Blog Terbaru</h2>

        <!-- Slider Berita Otomatis -->
        <div
            x-data="{}"
            x-init="$nextTick(() => {
                let ul = $refs.berita;
                ul.insertAdjacentHTML('afterend', ul.outerHTML);
                ul.nextSibling.setAttribute('aria-hidden', 'true');
            })"
            class="w-full inline-flex flex-nowrap overflow-hidden [mask-image:_linear-gradient(to_right,transparent_0,_black_128px,_black_calc(100%-128px),transparent_100%)]"
        >
         <ul x-ref="berita" class="flex items-center gap-6 animate-infinite-scroll px-2">

                @foreach ($blogs as $blog)
                    <li class="flex-shrink-0 w-80">
                        <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition overflow-hidden">
                            <a href="{{ route('blog.detail.main',[$blog->id]) }}">
                                <img src="{{ $blog->thumbnail_url }}" class="w-full h-44 object-cover" />
                                <div class="p-4">
                                    <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $blog->title }}</h3>
                                    <p class="text-gray-600 text-sm">
                                        {{ $blog->preview ?? Str::limit(strip_tags($blog->content ?? ''), 80) }}
                                    </p>
                                    <p class="text-xs text-gray-400 mt-2">{{ $blog->created_at->format('d M Y') }}</p>
                                </div>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Tombol Lihat Selengkapnya -->
        <div class="text-center mt-8">
            <a href="{{ route('berita.index') }}" class="bg-lime-600 text-white px-6 py-2 rounded hover:bg-lime-700 transition font-medium">
                Lihat Selengkapnya →
            </a>
        </div>
    </div>
</section>



{{-- Kontak dan Lokasi --}}
<section class="py-20 bg-gray-100">
    <div class="max-w-5xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-semibold text-gray-800 mb-4">Hubungi Kami</h2>
        <p class="text-gray-600">Padukuhan Gayam, Dusun Gayam, Desa Gayamharjo, Prambanan, Sleman</p>
        <p class="text-gray-600">Email: <a href="mailto:desaharmoni@example.com" class="text-blue-600 hover:underline">desaharmoni@example.com</a> | Telp: (021) 12345678</p>
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
