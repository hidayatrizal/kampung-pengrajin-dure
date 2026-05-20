@extends('layouts.app')

@section('title', 'Sejarah')

@section('content')
@include('components.navbar')

<main class="overflow-x-hidden">
    {{-- Hero --}}
    <section class="relative h-[55vh] min-h-[400px] flex items-center overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1523726491678-bf852e717f6a?q=80&w=2000&auto=format&fit=crop"
                 alt="Sejarah Desa Dure"
                 class="w-full h-full object-cover">
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-stone-900/80 via-stone-900/40 to-transparent dark:from-stone-950/90 dark:via-stone-950/60"></div>
        <div class="relative z-10 w-full max-w-7xl mx-auto px-5 md:px-10 lg:px-16">
            <div class="fade-in">
                <span class="inline-flex items-center gap-3 text-terracotta-400/90 text-[10px] uppercase tracking-[0.5em] font-semibold mb-6">
                    <span class="w-8 h-px bg-terracotta-500"></span>
                    Warisan Leluhur
                </span>
                <h1 class="font-serif text-5xl md:text-6xl lg:text-7xl text-white font-light leading-[1.05]">
                    Sejarah<br><span class="italic text-terracotta-300">Dure</span>
                </h1>
            </div>
        </div>
    </section>

    {{-- Content with Timeline --}}
    <section class="py-16 md:py-24 px-5 md:px-10 lg:px-16 bg-white dark:bg-stone-900">
        <div class="max-w-4xl mx-auto">

            {{-- Intro Quote --}}
            <div class="fade-in text-center mb-16 md:mb-24">
                <blockquote class="font-serif text-xl md:text-3xl lg:text-4xl text-stone-700 dark:text-stone-200 leading-[1.2] mb-8 text-balance">
                    "Kekuatan sebuah genteng bukan terletak pada satu lembar tanah liat, melainkan pada bagaimana ribuan lembar tersebut saling melindungi dan menopang satu sama lain."
                </blockquote>
                <div class="flex items-center justify-center gap-3">
                    <div class="w-8 h-px bg-terracotta-500"></div>
                    <cite class="text-[10px] uppercase tracking-[0.3em] text-terracotta-600 dark:text-terracotta-400 font-semibold">Pepatah Pengrajin Dure</cite>
                    <div class="w-8 h-px bg-terracotta-500"></div>
                </div>
            </div>

            {{-- Timeline --}}
            <div class="relative">
                {{-- Vertical Line --}}
                <div class="absolute left-[19px] md:left-[23px] top-0 bottom-0 w-px bg-stone-200 dark:bg-stone-700"></div>

                {{-- Chapter 1 --}}
                <div class="fade-in relative pl-14 md:pl-16 pb-16 md:pb-24">
                    {{-- Dot --}}
                    <div class="absolute left-[11px] md:left-[15px] top-1 w-[18px] md:w-[18px] h-[18px] rounded-full border-[3px] border-terracotta-500 bg-white dark:bg-stone-900 z-10"></div>

                    <span class="text-terracotta-600 dark:text-terracotta-400 text-[10px] uppercase tracking-[0.4em] font-bold">01 &mdash; Tradisi Sejak 1950</span>
                    <h2 class="font-serif text-3xl md:text-4xl text-stone-900 dark:text-white mt-3 mb-6 leading-[1.1]">
                        <span class="italic text-terracotta-500">Tiga Lapis</span>, Satu Warisan
                    </h2>
                    <div class="text-stone-500 dark:text-stone-400 leading-[1.85] text-[15px] space-y-5">
                        <p>
                            Desa Dure telah dikenal sebagai pusat kerajinan genteng sejak era 1950-an. Bermula dari kebutuhan sederhana masyarakat akan atap rumah yang kokoh, para leluhur mengembangkan teknik unik yang kini menjadi ciri khas tidak tertiru.
                        </p>
                        <p>
                            Teknik "<em class="font-serif not-italic text-terracotta-600 dark:text-terracotta-400">Tiga Lapis</em>" menjadi rahasia yang diwariskan turun-temurun — memberikan kekuatan struktur sekaligus keindahan yang memukau.
                        </p>
                    </div>
                </div>

                {{-- Chapter 2 --}}
                <div class="fade-in relative pl-14 md:pl-16 pb-16 md:pb-24">
                    {{-- Dot --}}
                    <div class="absolute left-[11px] md:left-[15px] top-1 w-[18px] h-[18px] rounded-full border-[3px] border-terracotta-500 bg-white dark:bg-stone-900 z-10"></div>

                    <span class="text-terracotta-600 dark:text-terracotta-400 text-[10px] uppercase tracking-[0.4em] font-bold">02 &mdash; Semangat Masa Kini</span>
                    <h2 class="font-serif text-3xl md:text-4xl text-stone-900 dark:text-white mt-3 mb-6 leading-[1.1]">
                        Dari Desa untuk<br><span class="italic text-terracotta-500">Dunia</span>
                    </h2>
                    <div class="text-stone-500 dark:text-stone-400 leading-[1.85] text-[15px] space-y-5">
                        <p>
                            Hari ini, Desa Dure bertransformasi menjadi ekonomi kreatif yang membanggakan. Dengan 150+ keluarga pengrajin dan 200+ jenis produk, kami tetap mempertahankan metode handmade sebagai inti dari setiap karya.
                        </p>
                        <p>
                            Di sanalah letak kemewahan sesungguhnya — dalam sentuhan tangan yang penuh ketulusan.
                        </p>
                    </div>
                </div>

                {{-- Chapter 3 --}}
                <div class="fade-in relative pl-14 md:pl-16">
                    {{-- Dot --}}
                    <div class="absolute left-[11px] md:left-[15px] top-1 w-[18px] h-[18px] rounded-full border-[3px] border-terracotta-500 bg-terracotta-500 z-10">
                        <div class="w-full h-full rounded-full bg-terracotta-500 animate-ping opacity-20"></div>
                    </div>

                    <span class="text-terracotta-600 dark:text-terracotta-400 text-[10px] uppercase tracking-[0.4em] font-bold">03 &mdash; Masa Depan</span>
                    <h2 class="font-serif text-3xl md:text-4xl text-stone-900 dark:text-white mt-3 mb-6 leading-[1.1]">
                        Warisan yang<br><span class="italic text-terracotta-500">Terus Hidup</span>
                    </h2>
                    <div class="text-stone-500 dark:text-stone-400 leading-[1.85] text-[15px] space-y-5">
                        <p>
                            Komitmen kami bukan hanya menjaga tradisi, tetapi membuktikkannya di panggung yang lebih luas. Setiap produk yang keluar dari Desa Dure adalah bukti bahwa kerajinan tradisional tetap relevan dan dibutuhkan dunia modern.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Stats --}}
            <div class="fade-in mt-20 md:mt-28 pt-12 border-t border-stone-100 dark:border-stone-800">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-12 text-center">
                    <div>
                        <div class="font-serif text-4xl md:text-5xl text-stone-900 dark:text-white mb-2 leading-none">70<span class="text-terracotta-500 text-2xl">+</span></div>
                        <div class="text-[10px] uppercase tracking-[0.2em] text-stone-400 font-semibold">Tahun Pengalaman</div>
                    </div>
                    <div>
                        <div class="font-serif text-4xl md:text-5xl text-stone-900 dark:text-white mb-2 leading-none">150<span class="text-terracotta-500 text-2xl">+</span></div>
                        <div class="text-[10px] uppercase tracking-[0.2em] text-stone-400 font-semibold">Keluarga Pengrajin</div>
                    </div>
                    <div>
                        <div class="font-serif text-4xl md:text-5xl text-stone-900 dark:text-white mb-2 leading-none">200<span class="text-terracotta-500 text-2xl">+</span></div>
                        <div class="text-[10px] uppercase tracking-[0.2em] text-stone-400 font-semibold">Jenis Produk</div>
                    </div>
                    <div>
                        <div class="font-serif text-4xl md:text-5xl text-stone-900 dark:text-white mb-2 leading-none">1950</div>
                        <div class="text-[10px] uppercase tracking-[0.2em] text-stone-400 font-semibold">Awal Berdiri</div>
                    </div>
                </div>
            </div>

            {{-- CTA --}}
            <div class="fade-in mt-20 md:mt-28 text-center">
                <p class="text-stone-400 dark:text-stone-500 text-sm font-light mb-6">Terinspirasi oleh cerita kami?</p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="{{ route('catalog') }}" class="inline-flex items-center justify-center gap-2 bg-terracotta-500 hover:bg-terracotta-600 text-white px-8 py-3.5 rounded-full text-[11px] font-semibold uppercase tracking-[0.15em] transition-all">
                        Lihat Produk
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                    <a href="{{ route('contact') }}" class="inline-flex items-center justify-center gap-2 border border-stone-300 dark:border-stone-700 text-stone-600 dark:text-stone-400 hover:border-terracotta-500 hover:text-terracotta-600 dark:hover:text-terracotta-400 px-8 py-3.5 rounded-full text-[11px] font-semibold uppercase tracking-[0.15em] transition-all">
                        Hubungi Kami
                    </a>
                </div>
            </div>

        </div>
    </section>
</main>
@endsection