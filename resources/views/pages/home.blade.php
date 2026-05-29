@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
@include('components.navbar', ['home' => true])

<main class="overflow-x-hidden">
    {{-- Hero Section --}}
    <section class="hero-section relative min-h-screen flex items-center overflow-hidden bg-cream-50 dark:bg-stone-950">
        {{-- Hero background image with WebP support for fast loading --}}
        <div class="absolute inset-0 overflow-hidden">
            <picture>
                <source srcset="/hero.webp" type="image/webp">
                <img src="/hero.png" alt="Desa Pengrajin Genteng" class="w-full h-full object-cover hero-img" fetchpriority="high" style="filter: hue-rotate(5deg) saturate(1.08)">
            </picture>
        </div>

        {{-- Gradient overlay with extended warm coverage to neutralize cool tones --}}
        <div class="absolute inset-0 bg-gradient-to-r from-cream-50 dark:from-stone-950 from-10% via-cream-50/85 dark:via-stone-950/90 via-40% to-cream-50/20 dark:to-stone-950/35 to-95%"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-cream-50 dark:from-stone-950 via-cream-50/40 dark:via-stone-950/40 via-40% to-transparent to-70% lg:hidden"></div>

        {{-- Content --}}
        <div class="relative z-10 w-full pl-5 md:pl-10 lg:pl-14 xl:pl-20 pr-8 md:pr-16 lg:pr-24 py-32 lg:py-0">
            <div class="max-w-xl lg:max-w-xl">

                {{-- Heading --}}
                <div class="fade-in hero-stagger-2 mb-6 lg:mb-8">
                    <h1 class="font-serif text-stone-900 dark:text-white leading-[1.05] tracking-[-0.02em]">
                        <span class="block text-[2.5rem] md:text-5xl lg:text-[3.75rem] xl:text-[4.5rem] font-semibold">Genteng</span>
                        <span class="block text-[2.5rem] md:text-5xl lg:text-[3.75rem] xl:text-[4.5rem] font-light">Berkualitas untuk</span>
                        <span class="block text-[2.5rem] md:text-5xl lg:text-[3.75rem] xl:text-[4.5rem] font-light">Bangunan <span class="italic text-terracotta-600 dark:text-terracotta-400 font-normal">Tahan Lama</span></span>
                    </h1>
                </div>

                {{-- Description --}}
                <div class="fade-in hero-stagger-3 mb-8 lg:mb-10">
                    <p class="text-stone-500 dark:text-stone-400 text-sm md:text-[15px] lg:text-base font-light leading-[1.85] max-w-lg">
                        Diproduksi oleh pengrajin berpengalaman dengan tanah liat pilihan dan proses alami. Kuat, indah, dan ramah lingkungan.
                    </p>
                </div>

                {{-- CTA Buttons --}}
                <div class="fade-in hero-stagger-4 flex flex-wrap items-center gap-3 lg:gap-4 mb-12 lg:mb-16">
                    <a href="{{ route('catalog') }}" class="group inline-flex items-center gap-2.5 bg-terracotta-500 hover:bg-terracotta-600 text-white px-7 md:px-9 py-4 rounded-full text-[11px] md:text-xs font-semibold uppercase tracking-[0.15em] transition-all duration-300 shadow-lg shadow-terracotta-500/20 dark:shadow-terracotta-500/10 hover:shadow-terracotta-600/30">
                        <span>Lihat Produk</span>
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-2.5 border-2 border-stone-300 dark:border-stone-600 hover:border-stone-400 dark:hover:border-stone-500 text-stone-700 dark:text-stone-300 hover:text-stone-900 dark:hover:text-white px-7 md:px-9 py-4 rounded-full text-[11px] md:text-xs font-semibold uppercase tracking-[0.15em] transition-all duration-300 bg-white/50 dark:bg-white/5 backdrop-blur-sm">
                        Hubungi Kami
                    </a>
                </div>

                {{-- Feature Highlights --}}
                <div class="fade-in hero-stagger-5 grid grid-cols-1 gap-4 md:grid-cols-3 md:gap-6 lg:gap-8 mt-10 md:mt-0">
                    <div class="flex items-start gap-3.5">
                        <div class="flex-shrink-0 w-11 h-11 rounded-xl bg-terracotta-50 dark:bg-terracotta-500/10 border border-terracotta-200/50 dark:border-terracotta-500/20 flex items-center justify-center">
                            <svg class="w-5 h-5 text-terracotta-600 dark:text-terracotta-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M12 21c-4-4-8-7.5-8-11a4 4 0 0 1 8 0 4 4 0 0 1 8 0c0 3.5-4 7-8 11z"/></svg>
                        </div>
                        <div>
                            <div class="text-stone-800 dark:text-stone-200 text-sm font-semibold leading-snug">Bahan Alami</div>
                            <div class="text-stone-400 dark:text-stone-500 text-[11px] font-light mt-0.5 leading-snug">Tanah liat pilihan</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-3.5">
                        <div class="flex-shrink-0 w-11 h-11 rounded-xl bg-terracotta-50 dark:bg-terracotta-500/10 border border-terracotta-200/50 dark:border-terracotta-500/20 flex items-center justify-center">
                            <svg class="w-5 h-5 text-terracotta-600 dark:text-terracotta-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <div>
                            <div class="text-stone-800 dark:text-stone-200 text-sm font-semibold leading-snug">Kuat & Tahan Lama</div>
                            <div class="text-stone-400 dark:text-stone-500 text-[11px] font-light mt-0.5 leading-snug">Garansi kualitas</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-3.5">
                        <div class="flex-shrink-0 w-11 h-11 rounded-xl bg-terracotta-50 dark:bg-terracotta-500/10 border border-terracotta-200/50 dark:border-terracotta-500/20 flex items-center justify-center">
                            <svg class="w-5 h-5 text-terracotta-600 dark:text-terracotta-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <div>
                            <div class="text-stone-800 dark:text-stone-200 text-sm font-semibold leading-snug">Buatan Lokal</div>
                            <div class="text-stone-400 dark:text-stone-500 text-[11px] font-light mt-0.5 leading-snug">Pengrajin berpengalaman</div>
</div>
            </div>

        {{-- Mobile Stats (visible only on mobile/tablet) --}}
        <div class="lg:hidden px-5 md:px-10 py-8 -mt-2">
            <div class="fade-in flex items-center justify-center gap-6">
                <div class="text-center">
                    <div class="font-serif text-xl text-terracotta-600 dark:text-terracotta-400 leading-none">150<span class="text-sm ml-0.5">+</span></div>
                    <div class="text-[9px] uppercase tracking-[0.2em] text-stone-500 dark:text-stone-400 font-semibold mt-1">Pengrajin</div>
                </div>
                <div class="w-px h-8 bg-stone-200 dark:bg-stone-700"></div>
                <div class="text-center">
                    <div class="font-serif text-xl text-terracotta-600 dark:text-terracotta-400 leading-none">200<span class="text-sm ml-0.5">+</span></div>
                    <div class="text-[9px] uppercase tracking-[0.2em] text-stone-500 dark:text-stone-400 font-semibold mt-1">Produk</div>
                </div>
                <div class="w-px h-8 bg-stone-200 dark:bg-stone-700"></div>
                <div class="text-center">
                    <div class="font-serif text-xl text-terracotta-600 dark:text-terracotta-400 leading-none">70<span class="text-sm ml-0.5">+</span></div>
                    <div class="text-[9px] uppercase tracking-[0.2em] text-stone-500 dark:text-stone-400 font-semibold mt-1">Tahun</div>
                </div>
            </div>
        </div>
    </section>

    {{-- Wave Divider --}}
    <div class="relative -mt-px">
        <svg class="w-full h-16 md:h-20 text-white dark:bg-stone-950" viewBox="0 0 1440 120" preserveAspectRatio="none" fill="currentColor">
            <path d="M0,64 C360,120 1080,0 1440,64 L1440,120 L0,120 Z"/>
        </svg>
    </div>

    {{-- About - Asymmetric layout with image reveal animation --}}
    <section class="py-16 md:py-20 lg:py-28 px-6 bg-white dark:bg-stone-900">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14 items-center">
                <div class="lg:col-span-5 fade-in">
                    <div class="relative">
                        <div class="img-reveal overflow-hidden rounded-2xl">
                            <img src="/genteng1.jpeg" class="w-full aspect-[3/4] object-cover" alt="Genteng Berkualitas Desa Pengrajin">
                        </div>
                        <div class="absolute -bottom-6 -right-6 bg-terracotta-500 text-white px-6 py-4 rounded-xl hidden md:block shadow-xl shadow-terracotta-500/20">
                            <div class="font-serif text-3xl font-light">Sejak</div>
                            <div class="text-[11px] uppercase tracking-[0.3em] font-semibold">1950-an</div>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-7 lg:pl-10">
                    <div class="fade-in">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-8 h-px bg-terracotta-500"></div>
                            <span class="text-terracotta-600 dark:text-terracotta-400 font-semibold uppercase tracking-[0.3em] text-[11px]">Tentang Kami</span>
                        </div>
                        <h2 class="font-serif text-4xl md:text-5xl lg:text-6xl text-stone-900 dark:text-white mb-10 leading-[1.05] text-balance">
                            Identitas yang<br><span class="italic text-terracotta-500">Dianyam</span> dengan Hati.
                        </h2>
                    </div>
                    <div class="fade-in" style="transition-delay: 200ms">
                        <div class="space-y-6 text-stone-500 dark:text-stone-400 leading-[1.9] text-[15px] max-w-xl">
                            <p>
                                Desa Dure telah lama dikenal sebagai jantung kreativitas lokal. Setiap rumah di desa kami bukan sekadar tempat tinggal, melainkan bengkel seni tempat keterampilan diturunkan dari satu generasi ke generasi berikutnya.
                            </p>
                            <p>
                                Melalui inisiatif UMKM Desa Dure, kami bertekad menjaga relevansi budaya ini di dunia modern. Produk kami bukan sekadar barang fungsional&mdash;mereka adalah simbol ketahanan budaya dan dedikasi pengrajin kami terhadap kualitas.
                            </p>
                        </div>
                    </div>
                    <div class="fade-in mt-14 grid grid-cols-2 gap-x-12 gap-y-6" style="transition-delay: 350ms">
                        <div class="border-t border-cream-300 dark:border-stone-700 pt-6">
                            <div class="font-serif text-4xl md:text-5xl text-stone-900 dark:text-white mb-1 leading-none">150<span class="text-terracotta-500">+</span></div>
                            <div class="text-[11px] uppercase tracking-[0.25em] text-stone-500 dark:text-stone-400 font-semibold mt-2">Keluarga Pengrajin</div>
                        </div>
                        <div class="border-t border-cream-300 dark:border-stone-700 pt-6">
                            <div class="font-serif text-4xl md:text-5xl text-stone-900 dark:text-white mb-1 leading-none">200<span class="text-terracotta-500">+</span></div>
                            <div class="text-[11px] uppercase tracking-[0.25em] text-stone-500 dark:text-stone-400 font-semibold mt-2">Jenis Produk</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Horizontal Divider --}}
    <div class="max-w-7xl mx-auto px-6">
        <div class="reveal-line h-px bg-cream-300 dark:bg-stone-700"></div>
    </div>

    {{-- Featured Products --}}
    <section class="py-16 md:py-20 lg:py-28 px-6 bg-cream-50 dark:bg-stone-950">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 md:mb-16 gap-6">
                <div class="fade-in">
                    <div class="flex items-center gap-4 mb-5">
                        <div class="w-8 h-px bg-terracotta-500"></div>
                        <span class="text-terracotta-600 dark:text-terracotta-400 font-semibold uppercase tracking-[0.3em] text-[11px]">Koleksi Pilihan</span>
                    </div>
                    <h2 class="font-serif text-4xl md:text-5xl lg:text-6xl text-stone-900 dark:text-white leading-[1.05] text-balance">Mahakarya<br><span class="italic text-terracotta-500">Unggulan</span></h2>
                </div>
                <a href="{{ route('catalog') }}" class="fade-in group inline-flex items-center gap-2 bg-white dark:bg-stone-800 hover:bg-terracotta-50 dark:hover:bg-terracotta-500/10 text-terracotta-600 dark:text-terracotta-400 hover:text-terracotta-700 dark:hover:text-terracotta-400 px-6 py-3 rounded-full text-sm uppercase tracking-[0.15em] font-semibold transition-all duration-300 border border-cream-300 dark:border-stone-700 hover:border-terracotta-200 dark:hover:border-terracotta-500/20">
                    Lihat Semua
                    <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-14">
                @foreach($products as $index => $product)
                <div class="fade-in" style="transition-delay: {{ $index * 150 }}ms">
                    @include('components.product-card', ['product' => $product])
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Wide Quote Banner --}}
    <section class="relative py-16 md:py-24 px-6 bg-terracotta-800 dark:bg-terracotta-900 overflow-hidden">
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: url('data:image/svg+xml,<svg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;><g fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;><g fill=&quot;%23ffffff&quot;><path d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/></g></g></svg>');"></div>
        <div class="max-w-4xl mx-auto text-center relative z-10">
            <div class="fade-in">
                <svg class="w-10 h-10 text-terracotta-300 dark:text-terracotta-400 mx-auto mb-8 opacity-50" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.706 3.731-9.572 9-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9zm-14.017 0v-7.391c0-5.706 3.748-9.572 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.985v10h-9z"/></svg>
                <blockquote class="font-serif text-2xl md:text-4xl text-white/90 leading-snug mb-8 text-balance">
                    Kekuatan sebuah genteng bukan terletak pada satu lembar tanah liat, melainkan pada bagaimana ribuan lembar tersebut saling melindungi dan menopang satu sama lain.
                </blockquote>
                <div class="flex items-center justify-center gap-3">
                    <div class="w-8 h-px bg-terracotta-300 dark:bg-terracotta-400"></div>
                    <cite class="text-terracotta-200/80 text-[11px] uppercase tracking-[0.3em] font-semibold not-italic">Pepatah Desa Genteng</cite>
                    <div class="w-8 h-px bg-terracotta-300 dark:bg-terracotta-400"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- Craftsmen Section --}}
    <section class="py-16 md:py-20 lg:py-28 px-6 bg-white dark:bg-stone-900">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-14 md:mb-18 fade-in">
                <div class="flex items-center justify-center gap-4 mb-5">
                    <div class="w-8 h-px bg-terracotta-500"></div>
                    <span class="text-terracotta-600 dark:text-terracotta-400 font-semibold uppercase tracking-[0.3em] text-[11px]">Sang Maestro</span>
                    <div class="w-8 h-px bg-terracotta-500"></div>
                </div>
                <h2 class="font-serif text-4xl md:text-5xl lg:text-6xl text-stone-900 dark:text-white mb-6 leading-[1.05]">Jiwa di Balik <span class="italic text-terracotta-500">Karya</span></h2>
                <p class="text-stone-400 dark:text-stone-500 max-w-xl mx-auto font-light leading-relaxed">Bertemu dengan para pahlawan budaya kami yang mendedikasikan hidupnya untuk kesempurnaan setiap detail.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                @foreach($craftsmen as $index => $craftsman)
                <div class="fade-in group" style="transition-delay: {{ $index * 200 }}ms">
                    <div class="flex flex-col md:flex-row items-stretch bg-cream-50 dark:bg-stone-950 hover:bg-cream-100 dark:hover:bg-stone-800 transition-all duration-500 overflow-hidden rounded-2xl">
                        <div class="md:w-56 lg:w-64 flex-shrink-0 overflow-hidden">
                            <img src="{{ Storage::url($craftsman->image) }}" alt="{{ $craftsman->name }}" class="w-full h-64 md:h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-105">
                        </div>
                        <div class="flex flex-col justify-center p-8 lg:p-10 flex-grow">
                            <p class="text-[10px] uppercase tracking-[0.3em] text-terracotta-600 dark:text-terracotta-400 font-semibold mb-3">UMKM Desa Dure</p>
                            <h4 class="font-serif text-2xl lg:text-3xl text-stone-900 dark:text-white mb-5">{{ $craftsman->name }}</h4>
                            <div class="w-10 h-px bg-cream-300 dark:bg-stone-700 mb-5"></div>
                            @if($craftsman->description)
                            <p class="text-stone-500 dark:text-stone-400 font-light leading-[1.8] text-[15px] italic mb-4">"{{ $craftsman->description }}"</p>
                            @endif
                            @if($craftsman->address)
                            <p class="text-stone-400 dark:text-stone-500 text-xs flex items-center gap-1.5 mb-2">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                {{ $craftsman->address }}
                            </p>
                            @endif
                            @if($craftsman->capacity)
                            <p class="text-stone-400 dark:text-stone-500 text-xs flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                                Kapasitas {{ number_format($craftsman->capacity) }}/bulan
                            </p>
                            @endif
                            @if($craftsman->latitude && $craftsman->longitude)
                            <div class="mt-3 relative group/map rounded-lg overflow-hidden border border-cream-300 dark:border-stone-700">
                                <div id="home-map-{{ $craftsman->id }}" data-lat="{{ $craftsman->latitude }}" data-lng="{{ $craftsman->longitude }}" data-name="{{ $craftsman->name }}" class="h-[140px] w-full"></div>
                                <a href="https://www.google.com/maps?q={{ $craftsman->latitude }},{{ $craftsman->longitude }}" target="_blank" rel="noopener" class="absolute inset-0 flex items-center justify-center bg-stone-900/0 group-hover/map:bg-stone-900/30 transition-all duration-300 z-[500]">
                                    <span class="opacity-0 group-hover/map:opacity-100 transition-all duration-300 transform translate-y-2 group-hover/map:translate-y-0 bg-white dark:bg-stone-800 text-stone-900 dark:text-white px-4 py-2 rounded-full text-[10px] font-semibold uppercase tracking-[0.12em] shadow-lg flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-terracotta-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                        Buka di Maps
                                    </span>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Gallery Section - Masonry with editorial feel --}}
    <section class="py-16 md:py-20 lg:py-28 px-6 bg-cream-50 dark:bg-stone-950">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 md:mb-16 gap-6">
                <div class="fade-in">
                    <div class="flex items-center gap-4 mb-5">
                        <div class="w-8 h-px bg-terracotta-500"></div>
                        <span class="text-terracotta-600 dark:text-terracotta-400 font-semibold uppercase tracking-[0.3em] text-[11px]">Momen Dure</span>
                    </div>
                    <h2 class="font-serif text-4xl md:text-5xl lg:text-6xl text-stone-900 dark:text-white leading-[1.05]">Galeri <span class="italic text-terracotta-500">Kreativitas</span></h2>
                </div>
                <a href="{{ route('contact') }}" class="fade-in group inline-flex items-center gap-2 bg-white dark:bg-stone-800 hover:bg-terracotta-50 dark:hover:bg-terracotta-500/10 text-terracotta-600 dark:text-terracotta-400 hover:text-terracotta-700 dark:hover:text-terracotta-400 px-6 py-3 rounded-full text-sm uppercase tracking-[0.15em] font-semibold transition-all duration-300 border border-cream-300 dark:border-stone-700 hover:border-terracotta-200 dark:hover:border-terracotta-500/20">
                    Kunjungi Kami
                    <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-4">
                @foreach($galleries as $index => $item)
                @php $aspectClass = $index === 0 ? 'aspect-[4/5]' : ($index === 3 ? 'aspect-square' : 'aspect-[3/4]'); @endphp
                <div class="fade-in relative group overflow-hidden rounded-xl {{ $index === 0 ? 'lg:col-span-2 lg:row-span-2' : '' }}" style="transition-delay: {{ $index * 100 }}ms">
                    <img src="{{ Storage::url($item->url) }}" alt="{{ $item->title }}" class="w-full {{ $aspectClass }} object-cover transition-all duration-700 group-hover:scale-105 group-hover:opacity-90">
                    <div class="absolute inset-0 bg-gradient-to-t from-stone-900/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-6 rounded-xl">
                        <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                            <p class="text-[10px] uppercase tracking-[0.3em] text-terracotta-300 dark:text-terracotta-400 font-semibold mb-1">{{ $item->category }}</p>
                            <h5 class="text-white font-serif text-lg lg:text-xl">{{ $item->title }}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</main>

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('[id^="home-map-"]').forEach(function(el) {
        var lat = parseFloat(el.dataset.lat);
        var lng = parseFloat(el.dataset.lng);
        var name = el.dataset.name || '';
        if (!isNaN(lat) && !isNaN(lng)) {
            var map = L.map(el.id).setView([lat, lng], 14);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap'
            }).addTo(map);
            L.marker([lat, lng]).addTo(map).bindPopup('<strong>' + name + '</strong>');
            setTimeout(function() { map.invalidateSize(); }, 500);
        }
    });
});
</script>
@endsection