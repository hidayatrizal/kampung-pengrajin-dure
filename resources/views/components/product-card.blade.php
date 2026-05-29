<div class="group flex flex-col h-full bg-white dark:bg-stone-900 transition-all duration-700 hover:shadow-[0_2px_40px_-8px_rgba(120,53,15,0.15)]">
    <div class="relative aspect-[4/5] overflow-hidden">
        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-all duration-1000 group-hover:scale-105 saturate-100 group-hover:saturate-110">
        <div class="absolute inset-0 bg-gradient-to-t from-stone-900/60 via-stone-900/0 to-stone-900/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 md:block hidden"></div>
        @if($product->craftsman)
        <div class="absolute top-5 left-5">
            <span class="inline-block bg-white/95 dark:bg-stone-800/95 backdrop-blur-sm text-stone-800 dark:text-stone-200 text-[10px] font-bold uppercase tracking-[0.2em] px-4 py-1.5 border border-stone-200/60 dark:border-stone-700/60">
                {{ $product->category }}
            </span>
        </div>
        <div class="absolute top-5 right-5">
            <a href="{{ route('catalog', ['toko' => $product->craftsman_id]) }}" class="inline-flex items-center gap-1.5 bg-terracotta-500/90 backdrop-blur-sm text-white text-[9px] font-bold uppercase tracking-[0.1em] px-3 py-1.5 rounded-full hover:bg-terracotta-600 transition-colors">
                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
                {{ $product->craftsman->name }}
            </a>
        </div>
        @else
        <div class="absolute top-5 left-5">
            <span class="inline-block bg-white/95 dark:bg-stone-800/95 backdrop-blur-sm text-stone-800 dark:text-stone-200 text-[10px] font-bold uppercase tracking-[0.2em] px-4 py-1.5 border border-stone-200/60 dark:border-stone-700/60">
                {{ $product->category }}
            </span>
        </div>
        @endif
        {{-- WhatsApp overlay - desktop hover only --}}
        <div class="absolute bottom-0 left-0 right-0 p-6 translate-y-full group-hover:translate-y-0 transition-transform duration-500 ease-out hidden md:block">
            <a href="https://wa.me/{{ $product->wa ?? '6281234567890' }}?text={{ urlencode('Halo, saya tertarik dengan produk ' . $product->name . ' dari Desa Dure. Boleh minta informasi ketersediaan?') }}" target="_blank" class="flex items-center justify-center gap-2.5 w-full bg-[#25D366] hover:bg-[#1da851] text-white py-3.5 transition-colors duration-300">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                <span class="text-[11px] font-bold uppercase tracking-[0.15em]">Pesan Sekarang</span>
            </a>
        </div>
    </div>

    <div class="flex flex-col flex-grow px-5 md:px-8 pt-6 pb-6 md:pb-8">
        <div class="flex items-start justify-between gap-3 mb-3">
            <h3 class="font-serif text-lg md:text-2xl text-stone-900 dark:text-white leading-snug">{{ $product->name }}</h3>
            <span class="font-serif text-lg md:text-xl text-terracotta-700 dark:text-terracotta-400 shrink-0 mt-0.5">{{ $product->price }}</span>
        </div>
        @if($product->craftsman)
        <div class="flex items-center gap-1.5 mb-3">
            <svg class="w-3.5 h-3.5 text-terracotta-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
            <a href="{{ route('catalog', ['toko' => $product->craftsman_id]) }}" class="text-[11px] font-semibold text-terracotta-600 dark:text-terracotta-400 hover:text-terracotta-700 dark:hover:text-terracotta-300 uppercase tracking-wider transition-colors">{{ $product->craftsman->name }}</a>
        </div>
        @endif
        <div class="w-8 h-px bg-stone-200 dark:bg-stone-700 mb-4"></div>
        <p class="text-stone-500 dark:text-stone-400 text-sm font-light leading-[1.8] mb-6 md:mb-8 flex-grow line-clamp-3">
            {{ $product->description }}
        </p>
        <a href="https://wa.me/{{ $product->wa ?? '6281234567890' }}?text={{ urlencode('Halo, saya tertarik dengan produk ' . $product->name . ' dari Desa Dure. Boleh minta informasi ketersediaan?') }}" target="_blank" class="group/btn inline-flex items-center justify-center gap-2.5 w-full border border-stone-900 dark:border-stone-600 text-stone-900 dark:text-white py-4 text-[11px] font-bold uppercase tracking-[0.15em] hover:bg-stone-900 dark:hover:bg-white dark:hover:text-stone-900 hover:text-white transition-all duration-300">
            <svg class="w-4 h-4 transition-transform duration-300 group-hover/btn:scale-110" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            Hubungi via WhatsApp
        </a>
    </div>
</div>