<footer class="relative bg-stone-950 dark:bg-black text-stone-400 overflow-hidden">
    {{-- Decorative top border --}}
    <div class="w-full h-px bg-gradient-to-r from-transparent via-terracotta-500/50 to-transparent"></div>

    <div class="pt-16 md:pt-24 pb-8 md:pb-16 px-6">
        <div class="max-w-7xl mx-auto">
            {{-- Main Footer Content --}}
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 md:gap-8 mb-20">
                <div class="md:col-span-5">
                    <a href="{{ route('home') }}" class="inline-block group">
                        <div class="font-serif text-3xl md:text-4xl text-white font-light tracking-tighter mb-6">
                            <span class="text-terracotta-500">Desa Pengrajin</span><span class="text-stone-500"> Genteng</span><span class="text-stone-700">.</span>
                        </div>
                    </a>
                    <p class="text-stone-500 dark:text-stone-500 font-light leading-[1.8] text-[15px] max-w-sm mb-10">
                        Mendedikasikan diri untuk melestarikan tradisi melalui seni kerajinan tangan berkualitas tinggi. Dari Desa Dure, untuk estetika ruang Anda.
                    </p>
                    <div class="flex gap-5">
                        <a href="#" class="w-11 h-11 border border-stone-700 dark:border-stone-700 flex items-center justify-center text-stone-500 hover:border-terracotta-500 hover:text-terracotta-500 transition-all duration-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.773 1.691 4.773 4.918 0 3.258-.594 3.895-4.773 4.917-3.204.058-3.584.07-4.85.07-1.266 0-1.644-.012-4.85-.07-3.252-.148-4.773-1.69-4.773-4.917 0-3.258.594-3.895 4.773-4.917C10.356 2.175 10.734 2.163 12 2.163zm0-2.163C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.358-.2 6.78-2.618 6.98-6.98.058-1.28.072-1.689.072-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        <a href="#" class="w-11 h-11 border border-stone-700 dark:border-stone-700 flex items-center justify-center text-stone-500 hover:border-terracotta-500 hover:text-terracotta-500 transition-all duration-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="mailto:info@desadure.id" class="w-11 h-11 border border-stone-700 dark:border-stone-700 flex items-center justify-center text-stone-500 hover:border-terracotta-500 hover:text-terracotta-500 transition-all duration-300">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                        </a>
                    </div>
                </div>

                <div class="md:col-span-3">
                    <h5 class="text-[10px] uppercase tracking-[0.4em] text-white font-semibold mb-8">Navigasi</h5>
                    <ul class="space-y-1">
                        <li><a href="{{ route('home') }}" class="block py-2 text-stone-500 hover:text-terracotta-500 transition-colors text-[15px] font-light">Beranda</a></li>
                        <li><a href="{{ route('catalog') }}" class="block py-2 text-stone-500 hover:text-terracotta-500 transition-colors text-[15px] font-light">Produk</a></li>
                        <li><a href="{{ route('history') }}" class="block py-2 text-stone-500 hover:text-terracotta-500 transition-colors text-[15px] font-light">Sejarah</a></li>
                        <li><a href="{{ route('contact') }}" class="block py-2 text-stone-500 hover:text-terracotta-500 transition-colors text-[15px] font-light">Hubungi Kami</a></li>
                    </ul>
                </div>

                <div class="md:col-span-4">
                    <h5 class="text-[10px] uppercase tracking-[0.4em] text-white font-semibold mb-8">Hubungi Pengelola</h5>
                    <div class="space-y-5">
                        <div class="flex gap-4">
                            <svg class="w-[18px] h-[18px] text-terracotta-600 dark:text-terracotta-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            <span class="text-stone-500 font-light text-[15px] leading-relaxed">Pusat Kerajinan Terpadu, Jl. Raya Dure No. 45, Kec. Seni, Kabupaten Kultur</span>
                        </div>
                        <div class="flex gap-4">
                            <svg class="w-[18px] h-[18px] text-terracotta-600 dark:text-terracotta-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
                            <span class="text-stone-500 font-light text-[15px]">+62 812-3456-7890</span>
                        </div>
                        <div class="flex gap-4">
                            <svg class="w-[18px] h-[18px] text-terracotta-600 dark:text-terracotta-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                            <span class="text-stone-500 font-light text-[15px]">info@desadure.id</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bottom Bar --}}
            <div class="border-t border-stone-800 dark:border-stone-800 pt-10 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-[11px] uppercase tracking-[0.2em] text-stone-600 dark:text-stone-700">&copy; {{ date('Y') }} Desa Pengrajin Genteng. Seluruh hak dilindungi.</p>
                <div class="flex gap-8">
                    <a href="#" class="text-[11px] uppercase tracking-[0.2em] text-stone-600 dark:text-stone-700 hover:text-stone-400 dark:hover:text-stone-400 transition-colors py-2">Kebijakan Privasi</a>
                    <a href="#" class="text-[11px] uppercase tracking-[0.2em] text-stone-600 dark:text-stone-700 hover:text-stone-400 dark:hover:text-stone-400 transition-colors py-2">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </div>
</footer>