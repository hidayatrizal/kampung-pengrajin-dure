@extends('admin.layouts.app')

@section('title', 'Manajemen Galeri')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4 border-b border-stone-100 pb-6">
    <div>
        <h1 class="font-serif text-2xl text-stone-900 mb-1">Galeri</h1>
        <p class="text-stone-400 text-sm">Kelola foto dan dokumentasi kreativitas Desa Dure</p>
    </div>
    <a href="{{ route('admin.gallery.create') }}" class="bg-terracotta-500 hover:bg-terracotta-600 text-white px-5 py-2.5 rounded-xl text-[11px] font-semibold uppercase tracking-[0.15em] flex items-center gap-2 transition-all">
        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Tambah Foto Baru
    </a>
</div>

<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    @forelse($galleries as $item)
    <div class="group bg-white rounded-xl border border-stone-100 hover:border-terracotta-200 hover:shadow-sm transition-all overflow-hidden">
        <div class="aspect-[4/3] overflow-hidden">
            <img src="{{ $item->url }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        </div>
        <div class="p-3 flex items-center justify-between">
            <div class="min-w-0">
                <h5 class="font-serif text-sm text-stone-900 truncate">{{ $item->title }}</h5>
                <p class="text-[10px] uppercase tracking-widest text-stone-400">{{ $item->category }}</p>
            </div>
            <div class="flex gap-1.5 shrink-0">
                <a href="{{ route('admin.gallery.edit', $item) }}" class="p-2 text-stone-400 hover:text-terracotta-600 hover:bg-terracotta-50 rounded-lg transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                </a>
                <form method="POST" action="{{ route('admin.gallery.destroy', $item) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Hapus foto ini?')" class="p-2 text-stone-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-full text-center py-16 bg-white rounded-xl border border-stone-100">
        <svg class="w-12 h-12 text-stone-200 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
        <p class="text-stone-400 font-light">Belum ada foto.</p>
        <a href="{{ route('admin.gallery.create') }}" class="inline-block mt-4 text-sm text-terracotta-600 hover:text-terracotta-700 font-semibold">Tambah Foto Pertama &rarr;</a>
    </div>
    @endforelse
</div>
@endsection