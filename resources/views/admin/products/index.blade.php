@extends('admin.layouts.app')

@section('title', 'Manajemen Produk')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4 border-b border-stone-100 pb-6">
    <div>
        <h1 class="font-serif text-2xl text-stone-900 mb-1">Produk</h1>
        <p class="text-stone-400 text-sm">Kelola katalog produk UMKM Desa Dure</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="bg-terracotta-500 hover:bg-terracotta-600 text-white px-5 py-2.5 rounded-xl text-[11px] font-semibold uppercase tracking-[0.15em] flex items-center gap-2 transition-all">
        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Tambah Produk
    </a>
</div>

<div class="grid grid-cols-1 gap-3">
    @forelse($products as $product)
    <div class="flex items-center gap-4 p-4 bg-white rounded-xl border border-stone-100 hover:border-terracotta-200 hover:shadow-sm transition-all">
        <img src="{{ \Illuminate\Support\Facades\Storage::url($product->image) }}" class="w-14 h-14 object-cover rounded-lg border border-stone-100 shrink-0" alt="{{ $product->name }}">
        <div class="flex-1 min-w-0">
            <h5 class="font-serif text-base text-stone-900 truncate">{{ $product->name }}</h5>
            <p class="text-[10px] uppercase tracking-widest text-stone-400">
                {{ $product->category }} &middot; {{ $product->price }}
                @if($product->craftsman)
                    &middot; <span class="text-terracotta-600">{{ $product->craftsman->name }}</span>
                @endif
            </p>
        </div>
        <div class="flex gap-2 shrink-0">
            <a href="{{ route('admin.products.edit', $product) }}" class="p-2.5 text-stone-400 hover:text-terracotta-600 hover:bg-terracotta-50 rounded-lg transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            </a>
            <form method="POST" action="{{ route('admin.products.destroy', $product) }}">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Hapus produk ini?')" class="p-2.5 text-stone-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/></svg>
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="text-center py-16 bg-white rounded-xl border border-stone-100">
        <svg class="w-12 h-12 text-stone-200 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
        <p class="text-stone-400 font-light">Belum ada produk.</p>
        <a href="{{ route('admin.products.create') }}" class="inline-block mt-4 text-sm text-terracotta-600 hover:text-terracotta-700 font-semibold">Tambah Produk Pertama &rarr;</a>
    </div>
    @endforelse
</div>
@endsection