@extends('admin.layouts.app')

@section('title', 'Pesan Masuk')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4 border-b border-stone-100 pb-6">
    <div>
        <h1 class="font-serif text-2xl text-stone-900 mb-1">Pesan Masuk</h1>
        <p class="text-stone-400 text-sm">Kelola pesan dari pengunjung website</p>
    </div>
    <div class="flex items-center gap-3">
        @if($unreadCount > 0)
        <form method="POST" action="{{ route('admin.messages.markAllRead') }}">
            @csrf
            <button type="submit" class="bg-stone-900 hover:bg-stone-800 text-white px-5 py-2.5 rounded-xl text-[11px] font-semibold uppercase tracking-[0.15em] flex items-center gap-2 transition-all">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Tandai Semua Dibaca
            </button>
        </form>
        @endif
    </div>
</div>

{{-- Filter Tabs --}}
<div class="flex gap-2 mb-6">
    <a href="{{ route('admin.messages.index', ['filter' => 'all']) }}" class="px-4 py-2 rounded-lg text-xs font-semibold uppercase tracking-wider transition-all {{ $filter === 'all' ? 'bg-terracotta-500 text-white' : 'bg-stone-100 text-stone-500 hover:bg-stone-200' }}">Semua</a>
    <a href="{{ route('admin.messages.index', ['filter' => 'unread']) }}" class="px-4 py-2 rounded-lg text-xs font-semibold uppercase tracking-wider transition-all {{ $filter === 'unread' ? 'bg-terracotta-500 text-white' : 'bg-stone-100 text-stone-500 hover:bg-stone-200' }}">Belum Dibaca</a>
    <a href="{{ route('admin.messages.index', ['filter' => 'read']) }}" class="px-4 py-2 rounded-lg text-xs font-semibold uppercase tracking-wider transition-all {{ $filter === 'read' ? 'bg-terracotta-500 text-white' : 'bg-stone-100 text-stone-500 hover:bg-stone-200' }}">Sudah Dibaca</a>
</div>

<div class="space-y-3">
    @forelse($messages as $message)
    <a href="{{ route('admin.messages.show', $message) }}" class="flex items-start gap-4 p-5 bg-white rounded-xl border {{ $message->is_read ? 'border-stone-100' : 'border-terracotta-200 bg-terracotta-50/30' }} hover:shadow-md transition-all group">
        <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 {{ $message->is_read ? 'bg-stone-100' : 'bg-terracotta-100' }}">
            <span class="text-sm font-semibold {{ $message->is_read ? 'text-stone-400' : 'text-terracotta-600' }}">{{ strtoupper(substr($message->name, 0, 1)) }}</span>
        </div>
        <div class="flex-1 min-w-0">
            <div class="flex items-center justify-between mb-1">
                <div class="flex items-center gap-2">
                    <h5 class="text-sm {{ $message->is_read ? 'font-medium text-stone-600' : 'font-semibold text-stone-900' }} truncate">{{ $message->name }}</h5>
                    @if(!$message->is_read)
                    <span class="w-2 h-2 bg-terracotta-500 rounded-full shrink-0"></span>
                    @endif
                </div>
                <span class="text-[11px] text-stone-400 shrink-0 ml-3">{{ $message->created_at->diffForHumans() }}</span>
            </div>
            <p class="text-xs text-stone-500 font-medium truncate">{{ $message->subject }}</p>
            <p class="text-[11px] text-stone-400 mt-1 truncate">{{ Str::limit($message->message, 100) }}</p>
        </div>
        <svg class="w-4 h-4 text-stone-300 group-hover:text-terracotta-500 shrink-0 mt-1 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
    </a>
    @empty
    <div class="text-center py-16 bg-white rounded-xl border border-stone-100">
        <svg class="w-12 h-12 text-stone-200 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
        <p class="text-stone-400 font-light">Belum ada pesan masuk.</p>
    </div>
    @endforelse
</div>
@endsection