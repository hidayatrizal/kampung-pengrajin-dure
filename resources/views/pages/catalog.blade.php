@extends('layouts.app')

@section('title', 'Produk')

@section('content')
@include('components.navbar')

<main class="overflow-x-hidden">
    {{-- Header --}}
    <section class="pt-24 md:pt-36 pb-12 md:pb-16 px-4 md:px-6 bg-stone-900 dark:bg-stone-950 text-white">
        <div class="max-w-7xl mx-auto">
            <div class="fade-in">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-10 h-px bg-terracotta-500"></div>
                    <span class="text-terracotta-400/90 text-[11px] uppercase tracking-[0.5em] font-semibold">Koleksi Eksklusif</span>
                </div>
                <h1 class="font-serif text-5xl md:text-7xl font-light leading-[1.05] mb-4">Produk <span class="italic text-stone-400 dark:text-stone-500">Pengrajin Genteng</span></h1>
                <p class="text-stone-400 dark:text-stone-500 max-w-xl font-light leading-relaxed text-base">
                    Koleksi hasil kerajinan tangan pengrajin Desa Dure, dibuat dengan penuh dedikasi dan keahlian turun-temurun.
                </p>
            </div>
        </div>
    </section>

    {{-- Filter Bar --}}
    <section class="sticky top-[64px] md:top-[72px] z-40 bg-white/95 dark:bg-stone-900/95 backdrop-blur-xl border-b border-stone-100 dark:border-stone-800 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 md:px-6 py-3 md:py-4">
            <div class="flex flex-col gap-3">
                {{-- Toko/UMKM Filter Pills --}}
                <div class="flex items-center gap-2 overflow-x-auto pb-0.5 no-scrollbar">
                    <span class="shrink-0 text-[10px] uppercase tracking-[0.15em] text-stone-400 font-semibold mr-1">Toko:</span>
                    <a href="{{ route('catalog', array_filter(['category' => request('category'), 'search' => request('search')])) }}"
                       class="shrink-0 px-4 py-2 rounded-full text-[10px] md:text-[11px] font-semibold uppercase tracking-[0.15em] transition-all duration-300 {{ !request('toko') ? 'bg-stone-900 dark:bg-white text-white dark:text-stone-900 shadow-md' : 'bg-stone-100 dark:bg-stone-800 text-stone-500 dark:text-stone-400 hover:bg-stone-200 dark:hover:bg-stone-700 hover:text-stone-700 dark:hover:text-white' }}">
                        Semua
                    </a>
                    @foreach($craftsmen as $c)
                    <a href="{{ route('catalog', array_filter(['toko' => $c->id, 'category' => request('category'), 'search' => request('search')])) }}"
                       class="shrink-0 px-4 py-2 rounded-full text-[10px] md:text-[11px] font-semibold uppercase tracking-[0.15em] transition-all duration-300 {{ request('toko') == $c->id ? 'bg-stone-900 dark:bg-white text-white dark:text-stone-900 shadow-md' : 'bg-stone-100 dark:bg-stone-800 text-stone-500 dark:text-stone-400 hover:bg-stone-200 dark:hover:bg-stone-700 hover:text-stone-700 dark:hover:text-white' }}">
                        {{ $c->name }}
                    </a>
                    @endforeach
                </div>

                {{-- Category + Search Row --}}
                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 sm:items-center sm:justify-between">
                    <div class="flex items-center gap-2 overflow-x-auto pb-0.5 sm:pb-0 no-scrollbar">
                        @foreach($categories as $cat)
                        <a href="{{ route('catalog', array_filter(['category' => $cat, 'toko' => request('toko'), 'search' => request('search')])) }}"
                           class="shrink-0 px-4 py-2 rounded-full text-[10px] md:text-[11px] font-semibold uppercase tracking-[0.15em] transition-all duration-300 {{ request('category') == $cat ? 'bg-terracotta-500 text-white shadow-md shadow-terracotta-500/25' : 'bg-stone-100 dark:bg-stone-800 text-stone-500 dark:text-stone-400 hover:bg-stone-200 dark:hover:bg-stone-700 hover:text-stone-700 dark:hover:text-white' }}">
                            {{ $cat }}
                        </a>
                        @endforeach
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="relative flex-grow sm:flex-grow-0 sm:w-64 md:w-72">
                            <input type="text"
                                   id="catalog-search"
                                   name="search"
                                   value="{{ request('search') }}"
                                   placeholder="Cari produk..."
                                   class="w-full pl-9 pr-8 py-2 bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 rounded-full text-xs md:text-sm text-stone-700 dark:text-white placeholder:text-stone-400 dark:placeholder:text-stone-500 focus:outline-none focus:border-terracotta-400 dark:focus:border-terracotta-500 transition-colors">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                            @if(request('search') || request('toko') || request('category'))
                            <a href="{{ route('catalog') }}" class="absolute right-3 top-1/2 -translate-y-1/2 text-stone-400 hover:text-stone-600 dark:hover:text-white">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M6 18L18 6M6 6l12 12"/></svg>
                            </a>
                            @endif
                        </div>
                        <span class="hidden md:block text-[10px] text-stone-400 dark:text-stone-500 font-medium shrink-0">
                            {{ $products->count() }} produk
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Active Toko Banner --}}
    @if(request('toko') && $activeToko = $craftsmen->where('id', request('toko'))->first())
    <section class="py-6 md:py-8 px-4 md:px-6 bg-cream-50 dark:bg-stone-900 border-b border-stone-200 dark:border-stone-800">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-start gap-4 md:gap-6">
                @if($activeToko->image)
                <img src="{{ Storage::url($activeToko->image) }}" alt="{{ $activeToko->name }}" class="w-14 h-14 md:w-16 md:h-16 rounded-full object-cover border-2 border-terracotta-500/30 shrink-0">
                @endif
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between">
                        <h2 class="font-serif text-xl md:text-2xl text-stone-900 dark:text-white">{{ $activeToko->name }}</h2>
                        <a href="{{ route('catalog', array_filter(['category' => request('category'), 'search' => request('search')])) }}" class="shrink-0 p-1.5 rounded-full hover:bg-stone-100 dark:hover:bg-stone-800 transition-colors text-stone-400 hover:text-stone-600 dark:hover:text-white">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M6 18L18 6M6 6l12 12"/></svg>
                        </a>
                    </div>
                    <div class="flex flex-wrap items-center gap-x-4 gap-y-1 mt-1">
                        @if($activeToko->address)
                        <span class="text-xs text-stone-500 dark:text-stone-400 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            {{ $activeToko->address }}
                        </span>
                        @endif
                        @if($activeToko->capacity)
                        <span class="text-xs text-stone-500 dark:text-stone-400 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                            Kapasitas {{ number_format($activeToko->capacity) }}/bulan
                        </span>
                        @endif
                        @if($activeToko->price)
                        <span class="text-xs text-terracotta-600 dark:text-terracotta-400 font-semibold">{{ $activeToko->price }}</span>
                        @endif
                    </div>
                    @if($activeToko->description)
                    <p class="text-sm text-stone-500 dark:text-stone-400 font-light leading-relaxed mt-2 line-clamp-2">{{ $activeToko->description }}</p>
                    @endif
                    @if($activeToko->latitude && $activeToko->longitude)
                    <div class="mt-4 relative group/map rounded-xl overflow-hidden border border-stone-200 dark:border-stone-700">
                        <div id="toko-map" data-lat="{{ $activeToko->latitude }}" data-lng="{{ $activeToko->longitude }}" data-name="{{ $activeToko->name }}" class="h-48 md:h-56 w-full"></div>
                        <a href="https://www.google.com/maps?q={{ $activeToko->latitude }},{{ $activeToko->longitude }}" target="_blank" rel="noopener" class="absolute inset-0 flex items-center justify-center bg-stone-900/0 group-hover/map:bg-stone-900/30 transition-all duration-300 z-[500]">
                            <span class="opacity-0 group-hover/map:opacity-100 transition-all duration-300 transform translate-y-2 group-hover/map:translate-y-0 bg-white dark:bg-stone-800 text-stone-900 dark:text-white px-5 py-2.5 rounded-full text-[11px] font-semibold uppercase tracking-[0.15em] shadow-lg flex items-center gap-2">
                                <svg class="w-4 h-4 text-terracotta-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                Buka di Google Maps
                            </span>
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- Products Grid --}}
    <section class="py-8 md:py-12 px-4 md:px-6 bg-cream-50 dark:bg-stone-950">
        <div class="max-w-7xl mx-auto">
            @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-14">
                @foreach($products as $index => $product)
                <div class="fade-in" style="transition-delay: {{ $index * 80 }}ms">
                    @include('components.product-card', ['product' => $product])
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-24">
                <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-stone-100 dark:bg-stone-800 flex items-center justify-center">
                    <svg class="w-8 h-8 text-stone-300 dark:text-stone-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                </div>
                <h3 class="font-serif text-2xl text-stone-700 dark:text-stone-300 mb-3">Tidak Ada Produk</h3>
                <p class="text-stone-400 dark:text-stone-500 font-light mb-8">Produk yang Anda cari tidak ditemukan.</p>
                <a href="{{ route('catalog') }}" class="inline-flex items-center gap-2 bg-terracotta-500 hover:bg-terracotta-600 text-white px-8 py-3.5 rounded-full text-[11px] font-semibold uppercase tracking-[0.15em] transition-all">
                    Lihat Semua Produk
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
            @endif
        </div>
    </section>
</main>

@endsection

@push('styles')
@if(request('toko') && $activeToko && $activeToko->latitude && $activeToko->longitude)
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    #toko-map { height: 200px; width: 100%; }
</style>
@endif
@endpush

@push('scripts')
@if(request('toko') && $activeToko && $activeToko->latitude && $activeToko->longitude)
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var mapEl = document.getElementById('toko-map');
    if (mapEl) {
        var lat = parseFloat(mapEl.dataset.lat);
        var lng = parseFloat(mapEl.dataset.lng);
        var name = mapEl.dataset.name || '';
        var map = L.map('toko-map').setView([lat, lng], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);
        L.marker([lat, lng]).addTo(map).bindPopup('<strong>' + name + '</strong>').openPopup();
        setTimeout(function() { map.invalidateSize(); }, 300);
    }
});
</script>
@endif

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var searchInput = document.getElementById('catalog-search');
    var timeout = null;

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                var query = searchInput.value.trim();
                var category = new URLSearchParams(window.location.search).get('category') || '';
                var toko = new URLSearchParams(window.location.search).get('toko') || '';
                var baseUrl = "{{ route('catalog') }}";
                var params = [];
                if (category) params.push('category=' + encodeURIComponent(category));
                if (toko) params.push('toko=' + encodeURIComponent(toko));
                if (query) params.push('search=' + encodeURIComponent(query));
                var url = baseUrl + (params.length ? '?' + params.join('&') : '');
                window.location.href = url;
            }, 500);
        });
    }
});
</script>
@endpush