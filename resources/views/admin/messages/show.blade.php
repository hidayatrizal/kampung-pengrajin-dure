@extends('admin.layouts.app')

@section('title', 'Detail Pesan')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center gap-2 text-sm text-stone-400 hover:text-terracotta-600 transition-colors mb-4">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
        Kembali ke Daftar Pesan
    </a>
</div>

<div class="bg-white rounded-2xl border border-stone-100 p-6 md:p-8">
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-6 pb-6 border-b border-stone-100">
        <div>
            <h2 class="font-serif text-xl text-stone-900 mb-2">{{ $message->subject }}</h2>
            <div class="flex flex-wrap items-center gap-3">
                <span class="text-sm text-stone-600 font-medium">{{ $message->name }}</span>
                <span class="text-stone-300">&middot;</span>
                <span class="text-sm text-stone-400">{{ $message->email }}</span>
                <span class="text-stone-300">&middot;</span>
                <span class="text-xs text-stone-400">{{ $message->created_at->format('d M Y, H:i') }}</span>
            </div>
        </div>
        <div class="flex items-center gap-3 shrink-0">
            @if(!$message->is_read)
            <span class="px-3 py-1 rounded-full bg-terracotta-100 text-terracotta-700 text-[10px] uppercase tracking-widest font-semibold">Baru</span>
            @else
            <span class="px-3 py-1 rounded-full bg-stone-100 text-stone-500 text-[10px] uppercase tracking-widest font-semibold">Dibaca</span>
            @endif
        </div>
    </div>

    {{-- Message Body --}}
    <div class="prose prose-stone max-w-none">
        <p class="text-stone-600 leading-relaxed whitespace-pre-line">{{ $message->message }}</p>
    </div>

    {{-- Actions --}}
    <div class="flex flex-wrap gap-3 mt-8 pt-6 border-t border-stone-100">
        <a href="mailto:{{ $message->email }}" class="bg-terracotta-500 hover:bg-terracotta-600 text-white px-6 py-2.5 rounded-xl text-[11px] font-semibold uppercase tracking-[0.15em] flex items-center gap-2 transition-all">
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
            Balas via Email
        </a>
        @php $waPhone = '6281234567890'; @endphp
        <a href="https://wa.me/{{ $waPhone }}?text={{ urlencode('Halo ' . $message->name . ', kami dari Desa Pengrajin Dure. Menanggapi pesan Anda tentang: ' . $message->subject) }}" target="_blank" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2.5 rounded-xl text-[11px] font-semibold uppercase tracking-[0.15em] flex items-center gap-2 transition-all">
            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.793.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.36-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
            Balas via WhatsApp
        </a>
        <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Hapus pesan ini?')" class="bg-white hover:bg-red-50 border border-stone-200 text-stone-500 hover:text-red-600 hover:border-red-200 px-6 py-2.5 rounded-xl text-[11px] font-semibold uppercase tracking-[0.15em] flex items-center gap-2 transition-all">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/></svg>
                Hapus
            </button>
        </form>
    </div>
</div>
@endsection