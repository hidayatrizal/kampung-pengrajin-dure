@extends('layouts.app')

@section('title', 'Hubungi Kami')

@section('content')
@include('components.navbar')

<main class="overflow-x-hidden">
    @if(session('success'))
    <div class="max-w-7xl mx-auto mt-8 px-6">
        <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-4 rounded-xl text-sm">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    </div>
    @endif

    {{-- Header --}}
    <section class="pt-28 md:pt-40 pb-16 md:pb-24 px-6 bg-stone-900 dark:bg-stone-950 text-white">
        <div class="max-w-7xl mx-auto">
            <div class="fade-in">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-10 h-px bg-terracotta-500"></div>
                    <span class="text-terracotta-400/90 text-[11px] uppercase tracking-[0.5em] font-semibold">Hubungi Kami</span>
                </div>
                <h1 class="font-serif text-5xl md:text-7xl font-light leading-[1.05] mb-8">Kami Siap<br><span class="italic text-terracotta-400/90">Mendengar</span></h1>
                <p class="text-stone-400 dark:text-stone-500 max-w-xl font-light leading-relaxed text-lg">
                    Punya pertanyaan tentang produk kami, ingin berkolaborasi, atau sekadar ingin menyapa? Jangan ragu untuk menghubungi tim kami.
                </p>
            </div>
        </div>
    </section>

    {{-- Contact Cards --}}
    <section class="py-16 md:py-24 px-6 bg-cream-50 dark:bg-stone-950">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="fade-in bg-white dark:bg-stone-900 p-10 group hover:bg-stone-900 dark:hover:bg-terracotta-800 transition-all duration-500 rounded-2xl">
                    <div class="w-12 h-12 border border-terracotta-600 dark:border-terracotta-500 flex items-center justify-center mb-8 group-hover:border-terracotta-400 group-hover:bg-terracotta-600 transition-all duration-500">
                        <svg class="w-5 h-5 text-terracotta-600 dark:text-terracotta-400 group-hover:text-white transition-colors duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <h3 class="font-serif text-2xl text-stone-900 dark:text-white group-hover:text-white mb-4 transition-colors duration-500">Alamat</h3>
                    <p class="text-stone-500 dark:text-stone-400 group-hover:text-stone-400 leading-relaxed transition-colors duration-500">Pusat Kerajinan Terpadu<br>Jl. Raya Dure No. 45<br>Kec. Seni, Kabupaten Kultur</p>
                </div>

                <div class="fade-in bg-white dark:bg-stone-900 p-10 group hover:bg-stone-900 dark:hover:bg-terracotta-800 transition-all duration-500 rounded-2xl" style="transition-delay: 150ms">
                    <div class="w-12 h-12 border border-terracotta-600 dark:border-terracotta-500 flex items-center justify-center mb-8 group-hover:border-terracotta-400 group-hover:bg-terracotta-600 transition-all duration-500">
                        <svg class="w-5 h-5 text-terracotta-600 dark:text-terracotta-400 group-hover:text-white transition-colors duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
                    </div>
                    <h3 class="font-serif text-2xl text-stone-900 dark:text-white group-hover:text-white mb-4 transition-colors duration-500">WhatsApp</h3>
                    <p class="text-stone-500 dark:text-stone-400 group-hover:text-stone-400 leading-relaxed transition-colors duration-500 mb-6">+62 812-3456-7890</p>
                    <a href="https://wa.me/6281234567890" target="_blank" class="inline-flex items-center gap-2 text-[11px] uppercase tracking-[0.2em] font-semibold text-terracotta-600 dark:text-terracotta-400 group-hover:text-terracotta-300 transition-colors duration-500">
                        Chat Sekarang
                        <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                </div>

                <div class="fade-in bg-white dark:bg-stone-900 p-10 group hover:bg-stone-900 dark:hover:bg-terracotta-800 transition-all duration-500 rounded-2xl" style="transition-delay: 300ms">
                    <div class="w-12 h-12 border border-terracotta-600 dark:border-terracotta-500 flex items-center justify-center mb-8 group-hover:border-terracotta-400 group-hover:bg-terracotta-600 transition-all duration-500">
                        <svg class="w-5 h-5 text-terracotta-600 dark:text-terracotta-400 group-hover:text-white transition-colors duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                    </div>
                    <h3 class="font-serif text-2xl text-stone-900 dark:text-white group-hover:text-white mb-4 transition-colors duration-500">Email</h3>
                    <p class="text-stone-500 dark:text-stone-400 group-hover:text-stone-400 leading-relaxed transition-colors duration-500 mb-1">info@desadure.id</p>
                    <p class="text-[10px] uppercase tracking-[0.3em] text-stone-400 dark:text-stone-500 group-hover:text-stone-400 transition-colors duration-500">Balas dalam 1x24 jam</p>
                </div>
            </div>

            <div class="mt-20 grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24">
                {{-- Form --}}
                <div class="fade-in">
                    <h2 class="font-serif text-3xl md:text-4xl text-stone-900 dark:text-white mb-10">Kirim Pesan</h2>
                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-8">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label for="contact-name" class="text-[10px] uppercase tracking-[0.3em] text-stone-500 dark:text-stone-400 font-semibold block mb-3">Nama Lengkap</label>
                                <input type="text" id="contact-name" name="name" required class="w-full bg-transparent border-b border-stone-300 dark:border-stone-700 py-3 outline-none focus:border-terracotta-600 dark:focus:border-terracotta-400 transition-colors text-stone-900 dark:text-white placeholder:text-stone-300 dark:placeholder:text-stone-600" placeholder="Nama Anda">
                            </div>
                            <div>
                                <label for="contact-email" class="text-[10px] uppercase tracking-[0.3em] text-stone-500 dark:text-stone-400 font-semibold block mb-3">Email</label>
                                <input type="email" id="contact-email" name="email" required class="w-full bg-transparent border-b border-stone-300 dark:border-stone-700 py-3 outline-none focus:border-terracotta-600 dark:focus:border-terracotta-400 transition-colors text-stone-900 dark:text-white placeholder:text-stone-300 dark:placeholder:text-stone-600" placeholder="email@contoh.com">
                            </div>
                        </div>
                        <div>
                            <label for="contact-subject" class="text-[10px] uppercase tracking-[0.3em] text-stone-500 dark:text-stone-400 font-semibold block mb-3">Subjek</label>
                            <input type="text" id="contact-subject" name="subject" required class="w-full bg-transparent border-b border-stone-300 dark:border-stone-700 py-3 outline-none focus:border-terracotta-600 dark:focus:border-terracotta-400 transition-colors text-stone-900 dark:text-white placeholder:text-stone-300 dark:placeholder:text-stone-600" placeholder="Perihal pesan Anda">
                        </div>
                        <div>
                            <label for="contact-message" class="text-[10px] uppercase tracking-[0.3em] text-stone-500 dark:text-stone-400 font-semibold block mb-3">Pesan</label>
                            <textarea id="contact-message" name="message" rows="5" required class="w-full bg-transparent border-b border-stone-300 dark:border-stone-700 py-3 outline-none focus:border-terracotta-600 dark:focus:border-terracotta-400 transition-colors text-stone-900 dark:text-white placeholder:text-stone-300 dark:placeholder:text-stone-600 resize-none" placeholder="Tulis pesan Anda di sini..."></textarea>
                        </div>
                        <button type="submit" class="group inline-flex items-center gap-3 bg-stone-900 dark:bg-terracotta-600 hover:bg-terracotta-600 dark:hover:bg-terracotta-700 text-white px-10 py-4 text-[11px] uppercase tracking-[0.2em] font-semibold transition-all duration-300 rounded-full">
                            Kirim Pesan
                            <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </button>
                    </form>
                </div>

                {{-- Map + Hours --}}
                <div class="fade-in" style="transition-delay: 200ms">
                    <h2 class="font-serif text-3xl md:text-4xl text-stone-900 dark:text-white mb-10">Lokasi Kami</h2>
                    <div class="bg-stone-200 dark:bg-stone-800 aspect-[16/10] mb-10 flex items-center justify-center relative overflow-hidden rounded-2xl">
                        <div class="text-center text-stone-500 dark:text-stone-400">
                            <svg class="w-10 h-10 mx-auto mb-3 text-stone-400 dark:text-stone-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            <p class="text-sm font-light">Peta lokasi Desa Dure</p>
                            <p class="text-xs text-stone-400 dark:text-stone-500 mt-1">Embed Google Maps di sini</p>
                        </div>
                    </div>
                    <div class="space-y-6">
                        <div class="flex items-start gap-5 border-t border-stone-200 dark:border-stone-700 pt-6">
                            <div class="w-10 h-10 bg-terracotta-50 dark:bg-terracotta-500/10 flex items-center justify-center flex-shrink-0 rounded-xl">
                                <svg class="w-5 h-5 text-terracotta-600 dark:text-terracotta-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            </div>
                            <div>
                                <p class="text-[11px] uppercase tracking-[0.3em] text-stone-500 dark:text-stone-400 font-semibold mb-1">Jam Operasional</p>
                                <p class="text-stone-700 dark:text-stone-300 font-light">Senin - Sabtu: 08.00 - 17.00 WIB</p>
                                <p class="text-stone-700 dark:text-stone-300 font-light">Minggu: 09.00 - 15.00 WIB</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection