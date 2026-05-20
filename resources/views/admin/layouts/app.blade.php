<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Admin Desa Pengrajin Genteng</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-serif { font-family: 'Cormorant Garamond', Georgia, serif; }
        .sidebar-link { display: flex; align-items: center; gap: 0.75rem; padding: 0.625rem 1rem; border-radius: 0.75rem; font-size: 0.8125rem; font-weight: 500; transition: all 0.2s; }
        .sidebar-link.active { background: rgb(120 53 15 / 0.15); color: #f97316; }
        .sidebar-link:not(.active) { color: #a1a1aa; }
        .sidebar-link:not(.active):hover { background: rgb(255 255 255 / 0.05); color: #e4e4e7; }
        .sidebar-badge { background: #ef4444; color: white; font-size: 10px; font-weight: 700; padding: 1px 6px; border-radius: 9999px; min-width: 18px; text-align: center; }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen bg-stone-50 text-stone-900">
    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside class="w-[260px] bg-stone-950 text-white flex-shrink-0 hidden lg:flex flex-col fixed inset-y-0 left-0">
            <div class="p-6 border-b border-white/5">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-terracotta-500/20 border border-terracotta-500/30 flex items-center justify-center">
                        <svg class="w-5 h-5 text-terracotta-400" viewBox="0 0 24 24" fill="currentColor"><path d="M3 21h1V7L12 3l8 4v14h1M7 21v-6a5 5 0 0 1 10 0v6M9 21v-5a3 3 0 0 1 6 0v5"/></svg>
                    </div>
                    <div>
                        <span class="font-serif text-lg font-semibold tracking-tight text-white">Desa Pengrajin</span>
                        <span class="block text-[8px] uppercase tracking-[0.3em] text-stone-500 font-medium -mt-0.5">Genteng</span>
                    </div>
                </a>
            </div>
            <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                <span class="block px-3 pt-4 pb-2 text-[9px] uppercase tracking-[0.3em] text-stone-600 font-semibold">Menu Utama</span>
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.products.index') }}" class="sidebar-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <svg class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
                    Produk
                </a>
                <a href="{{ route('admin.craftsmen.index') }}" class="sidebar-link {{ request()->routeIs('admin.craftsmen.*') ? 'active' : '' }}">
                    <svg class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    Toko/UMKM
                </a>
                <a href="{{ route('admin.gallery.index') }}" class="sidebar-link {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
                    <svg class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                    Galeri
                </a>
                <a href="{{ route('admin.messages.index') }}" class="sidebar-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                    <svg class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                    Pesan
                    @php $unreadCount = \App\Models\ContactMessage::where('is_read', false)->count(); @endphp
                    @if($unreadCount > 0)
                    <span class="sidebar-badge ml-auto">{{ $unreadCount }}</span>
                    @endif
                </a>

                <span class="block px-3 pt-6 pb-2 text-[9px] uppercase tracking-[0.3em] text-stone-600 font-semibold">Lainnya</span>
                <a href="{{ route('admin.profile.index') }}" class="sidebar-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                    <svg class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    Profil
                </a>
                <a href="{{ route('admin.settings.index') }}" class="sidebar-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <svg class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-2 2 2 2 0 01-2-2v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 01-2-2 2 2 0 012-2h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 010-2.83 2 2 0 012.83 0l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 012-2 2 2 0 012 2v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 0 2 2 0 010 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9c.26.604.852.997 1.51 1H21a2 2 0 012 2 2 2 0 01-2 2h-.09a1.65 1.65 0 00-1.51 1z"/></svg>
                    Pengaturan
                </a>
                <a href="{{ route('home') }}" target="_blank" class="sidebar-link">
                    <svg class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    Lihat Website
                </a>
            </nav>
            <div class="p-4 border-t border-white/5">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="sidebar-link w-full text-left">
                        <svg class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        {{-- Mobile Header --}}
        <div class="lg:hidden fixed top-0 left-0 right-0 z-40 bg-stone-950 text-white p-4 flex justify-between items-center shadow-lg">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-terracotta-500/20 border border-terracotta-500/30 flex items-center justify-center">
                    <svg class="w-4 h-4 text-terracotta-400" viewBox="0 0 24 24" fill="currentColor"><path d="M3 21h1V7L12 3l8 4v14h1M7 21v-6a5 5 0 0 1 10 0v6M9 21v-5a3 3 0 0 1 6 0v5"/></svg>
                </div>
                <span class="font-serif text-base font-semibold">Desa Pengrajin</span>
            </a>
            <button id="mobile-sidebar-btn" class="p-2 rounded-lg hover:bg-white/10 transition-colors" aria-label="Buka menu sidebar">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>

        {{-- Mobile Sidebar Overlay --}}
        <div id="mobile-sidebar" class="lg:hidden fixed inset-0 z-50 hidden" aria-hidden="true">
            <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" id="mobile-sidebar-overlay"></div>
            <div class="relative w-[280px] h-full bg-stone-950 text-white shadow-2xl">
                <div class="p-5 border-b border-white/5 flex justify-between items-center">
                    <span class="font-serif text-lg font-semibold">Desa Pengrajin <span class="text-stone-500 font-light">Genteng</span></span>
                    <button id="close-mobile-sidebar" class="p-1.5 rounded-lg hover:bg-white/10 transition-colors" aria-label="Tutup menu">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <nav class="p-4 space-y-1">
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <svg class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
                        Dashboard
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="sidebar-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                        <svg class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
                        Produk
                    </a>
                    <a href="{{ route('admin.craftsmen.index') }}" class="sidebar-link {{ request()->routeIs('admin.craftsmen.*') ? 'active' : '' }}">
                        <svg class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        Toko/UMKM
                    </a>
                    <a href="{{ route('admin.gallery.index') }}" class="sidebar-link {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
                        <svg class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        Galeri
                    </a>
                    <a href="{{ route('admin.messages.index') }}" class="sidebar-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                        <svg class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                        Pesan
                        @if($unreadCount ?? 0 > 0)
                        <span class="sidebar-badge ml-auto">{{ $unreadCount ?? 0 }}</span>
                        @endif
                    </a>
                    <div class="pt-4 mt-4 border-t border-white/5">
                        <a href="{{ route('admin.profile.index') }}" class="sidebar-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                            <svg class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            Profil
                        </a>
                        <a href="{{ route('admin.settings.index') }}" class="sidebar-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                            <svg class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-2 2 2 2 0 01-2-2v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 01-2-2 2 2 0 012-2h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 010-2.83 2 2 0 012.83 0l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 012-2 2 2 0 012 2v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 0 2 2 0 010 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9c.26.604.852.997 1.51 1H21a2 2 0 012 2 2 2 0 01-2 2h-.09a1.65 1.65 0 00-1.51 1z"/></svg>
                            Pengaturan
                        </a>
                        <a href="{{ route('home') }}" target="_blank" class="sidebar-link">
                            <svg class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                            Lihat Website
                        </a>
                    </div>
                    <form method="POST" action="{{ route('admin.logout') }}" class="mt-4 pt-4 border-t border-white/5">
                        @csrf
                        <button type="submit" class="sidebar-link w-full">
                            <svg class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                            Keluar
                        </button>
                    </form>
                </nav>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="flex-1 lg:ml-[260px]">
            {{-- Top Bar --}}
            <header class="bg-white border-b border-stone-100 px-6 md:px-8 py-4 flex items-center justify-between sticky top-0 z-30 lg:top-0 top-[56px]">
                <div>
                    <h1 class="font-serif text-xl text-stone-900">@yield('title', 'Dashboard')</h1>
                    <p class="text-xs text-stone-400 mt-0.5">Admin Panel</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.messages.index') }}" class="p-2.5 rounded-xl text-stone-400 hover:text-terracotta-600 hover:bg-terracotta-50 transition-all relative" title="Pesan Masuk">
                        <svg class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                        @php $unreadTopCount = \App\Models\ContactMessage::where('is_read', false)->count(); @endphp
                        @if($unreadTopCount > 0)
                        <span class="absolute -top-0.5 -right-0.5 w-4 h-4 bg-red-500 text-white text-[9px] font-bold rounded-full flex items-center justify-center">{{ $unreadTopCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('home') }}" target="_blank" class="p-2.5 rounded-xl text-stone-400 hover:text-stone-600 hover:bg-stone-50 transition-all" title="Lihat Website">
                        <svg class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </a>
                    <a href="{{ route('admin.profile.index') }}" class="w-9 h-9 rounded-xl bg-terracotta-500/10 flex items-center justify-center text-terracotta-600 font-semibold text-sm hover:bg-terracotta-500/20 transition-all" title="Profil">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </a>
                </div>
            </header>

            {{-- Content --}}
            <div class="p-5 md:p-8">
                @if(session('success'))
                <div class="mb-6 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-4 rounded-xl text-sm">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script>
        var mobileBtn = document.getElementById('mobile-sidebar-btn');
        var mobileSidebar = document.getElementById('mobile-sidebar');
        var overlay = document.getElementById('mobile-sidebar-overlay');
        var closeBtn = document.getElementById('close-mobile-sidebar');

        if (mobileBtn) {
            mobileBtn.addEventListener('click', function() {
                mobileSidebar.classList.remove('hidden');
                mobileSidebar.setAttribute('aria-hidden', 'false');
            });
        }
        if (overlay) {
            overlay.addEventListener('click', function() {
                mobileSidebar.classList.add('hidden');
                mobileSidebar.setAttribute('aria-hidden', 'true');
            });
        }
        if (closeBtn) {
            closeBtn.addEventListener('click', function() {
                mobileSidebar.classList.add('hidden');
                mobileSidebar.setAttribute('aria-hidden', 'true');
            });
        }
    </script>
    @stack('scripts')
</body>
</html>