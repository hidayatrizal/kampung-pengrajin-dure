@extends('admin.layouts.app')

@section('title', 'Pengaturan')

@section('content')
<div class="mb-8">
    <h2 class="font-serif text-2xl md:text-3xl text-stone-900 mb-1">Pengaturan Website</h2>
    <p class="text-stone-400 text-sm">Kelola informasi dan konten yang ditampilkan di website publik.</p>
</div>

<form method="POST" action="{{ route('admin.settings.update') }}">
    @csrf
    @method('PUT')

    @foreach($settings as $groupName => $groupSettings)
    <div class="bg-white rounded-2xl border border-stone-100 p-6 mb-6">
        <h3 class="font-serif text-lg text-stone-900 mb-5 flex items-center gap-3">
            @if($groupName === 'contact')
            <div class="w-9 h-9 rounded-lg bg-terracotta-50 flex items-center justify-center">
                <svg class="w-4.5 h-4.5 text-terracotta-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.851.573 2.81.7A2 2 0 0122 16.92z"/></svg>
            </div>
            Informasi Kontak
            @elseif($groupName === 'hero')
            <div class="w-9 h-9 rounded-lg bg-terracotta-50 flex items-center justify-center">
                <svg class="w-4.5 h-4.5 text-terracotta-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
            </div>
            Hero & Beranda
            @else
            <div class="w-9 h-9 rounded-lg bg-terracotta-50 flex items-center justify-center">
                <svg class="w-4.5 h-4.5 text-terracotta-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-2 2 2 2 0 01-2-2v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 01-2-2 2 2 0 012-2h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 010-2.83 2 2 0 012.83 0l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 012-2 2 2 0 012 2v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 0 2 2 0 010 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9c.26.604.852.997 1.51 1H21a2 2 0 012 2 2 2 0 01-2 2h-.09a1.65 1.65 0 00-1.51 1z"/></svg>
            </div>
            {{ ucfirst($groupName) }}
            @endif
        </h3>
        <div class="space-y-5">
            @foreach($groupSettings as $setting)
            <div>
                <label for="setting_{{ $setting->key }}" class="text-[10px] uppercase tracking-[0.2em] text-stone-500 font-semibold block mb-2">{{ $setting->label }}</label>
                @if($setting->type === 'textarea')
                <textarea id="setting_{{ $setting->key }}" name="{{ $setting->key }}" rows="3" class="w-full bg-white border border-stone-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-terracotta-400 focus:ring-1 focus:ring-terracotta-400 transition-all">{{ old($setting->key, $setting->value) }}</textarea>
                @else
                <input type="text" id="setting_{{ $setting->key }}" name="{{ $setting->key }}" value="{{ old($setting->key, $setting->value) }}" class="w-full bg-white border border-stone-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-terracotta-400 focus:ring-1 focus:ring-terracotta-400 transition-all">
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endforeach

    <div class="flex justify-end">
        <button type="submit" class="bg-terracotta-500 hover:bg-terracotta-600 text-white px-8 py-3 rounded-xl text-[11px] font-semibold uppercase tracking-[0.15em] flex items-center gap-2 transition-all">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M5 13l4 4L19 7"/></svg>
            Simpan Pengaturan
        </button>
    </div>
</form>
@endsection