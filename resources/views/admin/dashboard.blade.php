@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
{{-- Welcome Header --}}
<div class="mb-8">
    <h2 class="font-serif text-2xl md:text-3xl text-stone-900 mb-1">Selamat Datang</h2>
    <p class="text-stone-400 text-sm">Kelola konten dan katalog Desa Pengrajin Genteng dari panel ini.</p>
</div>

{{-- Stats Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-5 mb-8">
    <a href="{{ route('admin.products.index') }}" class="group bg-white rounded-2xl border border-stone-100 p-6 hover:border-terracotta-200 hover:shadow-lg hover:shadow-terracotta-500/5 transition-all duration-300">
        <div class="flex items-center justify-between mb-5">
            <div class="w-11 h-11 rounded-xl bg-terracotta-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-terracotta-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
            </div>
            <svg class="w-4 h-4 text-stone-300 group-hover:text-terracotta-500 group-hover:translate-x-0.5 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </div>
        <div class="font-serif text-3xl text-stone-900 mb-1">{{ $productsCount }}</div>
        <div class="text-xs uppercase tracking-[0.2em] text-stone-400 font-semibold">Total Produk</div>
    </a>

    <a href="{{ route('admin.craftsmen.index') }}" class="group bg-white rounded-2xl border border-stone-100 p-6 hover:border-terracotta-200 hover:shadow-lg hover:shadow-terracotta-500/5 transition-all duration-300">
        <div class="flex items-center justify-between mb-5">
            <div class="w-11 h-11 rounded-xl bg-terracotta-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-terracotta-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
            </div>
            <svg class="w-4 h-4 text-stone-300 group-hover:text-terracotta-500 group-hover:translate-x-0.5 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </div>
        <div class="font-serif text-3xl text-stone-900 mb-1">{{ $craftsmenCount }}</div>
        <div class="text-xs uppercase tracking-[0.2em] text-stone-400 font-semibold">Total Toko/UMKM</div>
    </a>

    <a href="{{ route('admin.gallery.index') }}" class="group bg-white rounded-2xl border border-stone-100 p-6 hover:border-terracotta-200 hover:shadow-lg hover:shadow-terracotta-500/5 transition-all duration-300">
        <div class="flex items-center justify-between mb-5">
            <div class="w-11 h-11 rounded-xl bg-terracotta-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-terracotta-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
            </div>
            <svg class="w-4 h-4 text-stone-300 group-hover:text-terracotta-500 group-hover:translate-x-0.5 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </div>
        <div class="font-serif text-3xl text-stone-900 mb-1">{{ $galleriesCount }}</div>
        <div class="text-xs uppercase tracking-[0.2em] text-stone-400 font-semibold">Total Galeri</div>
    </a>

    <a href="{{ route('admin.messages.index') }}" class="group bg-white rounded-2xl border border-stone-100 p-6 hover:border-terracotta-200 hover:shadow-lg hover:shadow-terracotta-500/5 transition-all duration-300">
        <div class="flex items-center justify-between mb-5">
            <div class="w-11 h-11 rounded-xl bg-terracotta-50 flex items-center justify-center relative">
                <svg class="w-5 h-5 text-terracotta-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                @if($unreadMessages > 0)
                <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center">{{ $unreadMessages }}</span>
                @endif
            </div>
            <svg class="w-4 h-4 text-stone-300 group-hover:text-terracotta-500 group-hover:translate-x-0.5 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </div>
        <div class="font-serif text-3xl text-stone-900 mb-1">{{ $unreadMessages }}</div>
        <div class="text-xs uppercase tracking-[0.2em] text-stone-400 font-semibold">Pesan Baru</div>
    </a>
</div>

{{-- Quick Actions --}}
<div class="bg-white rounded-2xl border border-stone-100 p-6 mb-8">
    <h3 class="font-serif text-lg text-stone-900 mb-5">Akses Cepat</h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <a href="{{ route('admin.products.create') }}" class="flex items-center gap-3 p-4 rounded-xl bg-stone-50 hover:bg-terracotta-50 transition-colors group">
            <div class="w-10 h-10 rounded-lg bg-terracotta-500 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            </div>
            <div>
                <div class="text-sm font-semibold text-stone-800 group-hover:text-terracotta-700 transition-colors">Tambah Produk</div>
                <div class="text-[11px] text-stone-400">Buat produk baru</div>
            </div>
        </a>
        <a href="{{ route('admin.craftsmen.create') }}" class="flex items-center gap-3 p-4 rounded-xl bg-stone-50 hover:bg-terracotta-50 transition-colors group">
            <div class="w-10 h-10 rounded-lg bg-terracotta-500 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            </div>
            <div>
                <div class="text-sm font-semibold text-stone-800 group-hover:text-terracotta-700 transition-colors">Tambah Toko/UMKM</div>
                <div class="text-[11px] text-stone-400">Data toko baru</div>
            </div>
        </a>
        <a href="{{ route('admin.gallery.create') }}" class="flex items-center gap-3 p-4 rounded-xl bg-stone-50 hover:bg-terracotta-50 transition-colors group">
            <div class="w-10 h-10 rounded-lg bg-terracotta-500 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            </div>
            <div>
                <div class="text-sm font-semibold text-stone-800 group-hover:text-terracotta-700 transition-colors">Tambah Galeri</div>
                <div class="text-[11px] text-stone-400">Upload foto baru</div>
            </div>
        </a>
        <a href="{{ route('admin.messages.index') }}" class="flex items-center gap-3 p-4 rounded-xl bg-stone-50 hover:bg-terracotta-50 transition-colors group">
            <div class="w-10 h-10 rounded-lg bg-terracotta-500 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
            </div>
            <div>
                <div class="text-sm font-semibold text-stone-800 group-hover:text-terracotta-700 transition-colors">Lihat Pesan</div>
                <div class="text-[11px] text-stone-400">{{ $unreadMessages }} pesan belum dibaca</div>
            </div>
        </a>
    </div>
</div>

{{-- Recent Activity & Category Overview --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    {{-- Recent Products --}}
    <div class="lg:col-span-2 bg-white rounded-2xl border border-stone-100 p-6">
        <div class="flex items-center justify-between mb-5">
            <h3 class="font-serif text-lg text-stone-900">Produk Terbaru</h3>
            <a href="{{ route('admin.products.index') }}" class="text-xs text-terracotta-600 hover:text-terracotta-700 font-semibold uppercase tracking-wider transition-colors">Lihat Semua</a>
        </div>
        @if($recentProducts->count() > 0)
        <div class="space-y-3">
            @foreach($recentProducts as $product)
            <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-stone-50 transition-colors">
                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-12 h-12 object-cover rounded-lg border border-stone-100 shrink-0">
                <div class="flex-1 min-w-0">
                    <h5 class="text-sm font-semibold text-stone-800 truncate">{{ $product->name }}</h5>
                    <p class="text-[11px] text-stone-400 uppercase tracking-wider">{{ $product->category }} &middot; {{ $product->price }}</p>
                </div>
                <span class="text-[10px] text-stone-400 shrink-0">{{ $product->created_at->diffForHumans() }}</span>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-8">
            <svg class="w-10 h-10 text-stone-200 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
            <p class="text-stone-400 text-sm">Belum ada produk.</p>
        </div>
        @endif
    </div>

    {{-- Category Overview --}}
    <div class="bg-white rounded-2xl border border-stone-100 p-6">
        <h3 class="font-serif text-lg text-stone-900 mb-5">Kategori Produk</h3>
        @if($categories->count() > 0)
        <div class="space-y-4">
            @foreach($categories as $category)
            <div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-medium text-stone-700">{{ $category->category }}</span>
                    <span class="text-xs text-stone-400 font-semibold">{{ $category->count }}</span>
                </div>
                <div class="w-full h-2 bg-stone-100 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-terracotta-400 to-terracotta-600 rounded-full transition-all duration-700" style="width: {{ $productsCount > 0 ? round(($category->count / $productsCount) * 100) : 0 }}%"></div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-8">
            <svg class="w-10 h-10 text-stone-200 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><path d="M3 9h18M9 21V9"/></svg>
            <p class="text-stone-400 text-sm">Belum ada kategori.</p>
        </div>
        @endif
    </div>
</div>

{{-- Recent Messages --}}
<div class="bg-white rounded-2xl border border-stone-100 p-6">
    <div class="flex items-center justify-between mb-5">
        <h3 class="font-serif text-lg text-stone-900">Pesan Masuk Terbaru</h3>
        <a href="{{ route('admin.messages.index') }}" class="text-xs text-terracotta-600 hover:text-terracotta-700 font-semibold uppercase tracking-wider transition-colors">Lihat Semua</a>
    </div>
    @if($recentMessages->count() > 0)
    <div class="space-y-3">
        @foreach($recentMessages as $msg)
        <a href="{{ route('admin.messages.show', $msg) }}" class="flex items-start gap-4 p-3 rounded-xl hover:bg-stone-50 transition-colors group">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 {{ $msg->is_read ? 'bg-stone-100' : 'bg-terracotta-50' }}">
                <span class="text-sm font-semibold {{ $msg->is_read ? 'text-stone-400' : 'text-terracotta-600' }}">{{ strtoupper(substr($msg->name, 0, 1)) }}</span>
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-2 mb-1">
                    <h5 class="text-sm font-semibold text-stone-800 truncate">{{ $msg->name }}</h5>
                    @if(!$msg->is_read)
                    <span class="w-2 h-2 bg-terracotta-500 rounded-full shrink-0"></span>
                    @endif
                </div>
                <p class="text-xs text-stone-500 font-medium truncate">{{ $msg->subject }}</p>
                <p class="text-[11px] text-stone-400 mt-0.5">{{ $msg->created_at->diffForHumans() }}</p>
            </div>
            <svg class="w-4 h-4 text-stone-300 group-hover:text-terracotta-500 shrink-0 mt-1 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
        @endforeach
    </div>
    @else
    <div class="text-center py-8">
        <svg class="w-10 h-10 text-stone-200 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
        <p class="text-stone-400 text-sm">Belum ada pesan masuk.</p>
    </div>
    @endif
</div>
@endsection