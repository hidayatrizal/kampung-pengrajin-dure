@extends('admin.layouts.app')

@section('title', 'Profil')

@section('content')
<div class="mb-8">
    <h2 class="font-serif text-2xl md:text-3xl text-stone-900 mb-1">Profil Admin</h2>
    <p class="text-stone-400 text-sm">Kelola informasi akun dan keamanan Anda.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    {{-- Update Name --}}
    <div class="bg-white rounded-2xl border border-stone-100 p-6">
        <h3 class="font-serif text-lg text-stone-900 mb-5 flex items-center gap-3">
            <div class="w-9 h-9 rounded-lg bg-terracotta-50 flex items-center justify-center">
                <svg class="w-4.5 h-4.5 text-terracotta-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            </div>
            Ubah Nama
        </h3>
        <form method="POST" action="{{ route('admin.profile.name') }}">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="name" class="text-[10px] uppercase tracking-[0.2em] text-stone-500 font-semibold block mb-2">Nama</label>
                    <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" required class="w-full bg-white border border-stone-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-terracotta-400 focus:ring-1 focus:ring-terracotta-400 transition-all">
                    @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="bg-terracotta-500 hover:bg-terracotta-600 text-white px-6 py-2.5 rounded-xl text-[11px] font-semibold uppercase tracking-[0.15em] transition-all">
                    Simpan Nama
                </button>
            </div>
        </form>
    </div>

    {{-- Change Password --}}
    <div class="bg-white rounded-2xl border border-stone-100 p-6">
        <h3 class="font-serif text-lg text-stone-900 mb-5 flex items-center gap-3">
            <div class="w-9 h-9 rounded-lg bg-terracotta-50 flex items-center justify-center">
                <svg class="w-4.5 h-4.5 text-terracotta-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
            </div>
            Ubah Password
        </h3>
        <form method="POST" action="{{ route('admin.profile.password') }}">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="current_password" class="text-[10px] uppercase tracking-[0.2em] text-stone-500 font-semibold block mb-2">Password Saat Ini</label>
                    <input type="password" id="current_password" name="current_password" required class="w-full bg-white border border-stone-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-terracotta-400 focus:ring-1 focus:ring-terracotta-400 transition-all">
                    @error('current_password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password" class="text-[10px] uppercase tracking-[0.2em] text-stone-500 font-semibold block mb-2">Password Baru</label>
                    <input type="password" id="password" name="password" required class="w-full bg-white border border-stone-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-terracotta-400 focus:ring-1 focus:ring-terracotta-400 transition-all">
                    @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="text-[10px] uppercase tracking-[0.2em] text-stone-500 font-semibold block mb-2">Konfirmasi Password Baru</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required class="w-full bg-white border border-stone-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-terracotta-400 focus:ring-1 focus:ring-terracotta-400 transition-all">
                </div>
                <button type="submit" class="bg-terracotta-500 hover:bg-terracotta-600 text-white px-6 py-2.5 rounded-xl text-[11px] font-semibold uppercase tracking-[0.15em] transition-all">
                    Ubah Password
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Account Info Card --}}
<div class="bg-white rounded-2xl border border-stone-100 p-6 mt-6">
    <h3 class="font-serif text-lg text-stone-900 mb-5 flex items-center gap-3">
        <div class="w-9 h-9 rounded-lg bg-terracotta-50 flex items-center justify-center">
            <svg class="w-4.5 h-4.5 text-terracotta-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        Informasi Akun
    </h3>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div>
            <div class="text-[10px] uppercase tracking-[0.2em] text-stone-400 font-semibold mb-1">Nama</div>
            <div class="text-sm font-medium text-stone-800">{{ auth()->user()->name }}</div>
        </div>
        <div>
            <div class="text-[10px] uppercase tracking-[0.2em] text-stone-400 font-semibold mb-1">Email</div>
            <div class="text-sm font-medium text-stone-800">{{ auth()->user()->email }}</div>
        </div>
        <div>
            <div class="text-[10px] uppercase tracking-[0.2em] text-stone-400 font-semibold mb-1">Bergabung</div>
            <div class="text-sm font-medium text-stone-800">{{ auth()->user()->created_at->format('d M Y') }}</div>
        </div>
    </div>
</div>
@endsection