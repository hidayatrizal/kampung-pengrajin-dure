<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Desa Pengrajin Genteng</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-serif { font-family: 'Cormorant Garamond', Georgia, serif; }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen bg-stone-50">

    {{-- Mobile Hero Banner (only visible on mobile/tablet) --}}
    <div class="lg:hidden relative overflow-hidden">
        <div class="absolute inset-0">
            <img src="/hero.png" alt="Desa Pengrajin Genteng" class="w-full h-56 object-cover object-center">
        </div>
        <div class="absolute inset-0 bg-gradient-to-b from-stone-900/40 via-stone-900/60 to-stone-900/90"></div>
        <div class="relative z-10 flex flex-col items-center justify-center text-center px-6 py-12 min-h-[280px]">
            <div class="flex items-center gap-2.5 mb-6">
                <div class="w-10 h-10 rounded-xl bg-terracotta-500/20 border border-terracotta-500/30 flex items-center justify-center">
                    <svg class="w-5 h-5 text-terracotta-400" viewBox="0 0 24 24" fill="currentColor"><path d="M3 21h1V7L12 3l8 4v14h1M7 21v-6a5 5 0 0 1 10 0v6M9 21v-5a3 3 0 0 1 6 0v5"/></svg>
                </div>
                <div class="text-left">
                    <span class="font-serif text-lg text-white font-semibold tracking-tight">Desa Pengrajin</span>
                    <span class="block text-[7px] uppercase tracking-[0.3em] text-stone-400 font-medium -mt-0.5">Genteng</span>
                </div>
            </div>
            <h2 class="font-serif text-2xl text-white font-light leading-snug mb-3">
                Kelola Konten<br><span class="italic text-terracotta-400">Dengan Mudah</span>
            </h2>
            <div class="flex items-center gap-5 mt-2">
                <div class="text-center">
                    <div class="font-serif text-xl text-white leading-none">150<span class="text-terracotta-400 text-base">+</span></div>
                    <div class="text-[8px] uppercase tracking-[0.15em] text-stone-400 mt-1">Pengrajin</div>
                </div>
                <div class="w-px h-8 bg-white/20"></div>
                <div class="text-center">
                    <div class="font-serif text-xl text-white leading-none">200<span class="text-terracotta-400 text-base">+</span></div>
                    <div class="text-[8px] uppercase tracking-[0.15em] text-stone-400 mt-1">Produk</div>
                </div>
                <div class="w-px h-8 bg-white/20"></div>
                <div class="text-center">
                    <div class="font-serif text-xl text-white leading-none">70<span class="terracotta-400 text-base">+</span></div>
                    <div class="text-[8px] uppercase tracking-[0.15em] text-stone-400 mt-1">Tahun</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Desktop + Mobile Layout Wrapper --}}
    <div class="min-h-screen flex">

        {{-- Left: Branding Panel (Desktop only — unchanged) --}}
        <div class="hidden lg:flex lg:w-[52%] relative bg-stone-900 overflow-hidden">
            <div class="absolute inset-0">
                <img src="/hero.png" alt="Desa Pengrajin Genteng" class="w-full h-full object-cover opacity-55 scale-105">
            </div>
            <div class="absolute inset-0 bg-gradient-to-br from-stone-900/70 via-stone-900/50 to-stone-800/60"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-stone-900/50 via-transparent to-transparent"></div>
            <div class="relative z-10 flex flex-col justify-between p-12 xl:p-16 w-full">
                <div>
                    <div class="flex items-center gap-3 mb-16">
                        <div class="w-11 h-11 rounded-xl bg-terracotta-500/20 border border-terracotta-500/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-terracotta-400" viewBox="0 0 24 24" fill="currentColor"><path d="M3 21h1V7L12 3l8 4v14h1M7 21v-6a5 5 0 0 1 10 0v6M9 21v-5a3 3 0 0 1 6 0v5"/></svg>
                        </div>
                        <div>
                            <span class="font-serif text-xl text-white font-semibold tracking-tight">Desa Pengrajin</span>
                            <span class="block text-[8px] uppercase tracking-[0.3em] text-stone-500 font-medium -mt-0.5">Genteng</span>
                        </div>
                    </div>
                    <h2 class="font-serif text-4xl xl:text-5xl text-white font-light leading-[1.1] mb-6">
                        Kelola Konten<br><span class="italic text-terracotta-400">Dengan Mudah</span>
                    </h2>
                    <p class="text-stone-400 font-light leading-relaxed max-w-sm text-[15px]">
                        Panel admin untuk mengelola produk, pengrajin, dan galeri Desa Pengrajin Genteng.
                    </p>
                </div>
                <div class="flex items-center gap-8">
                    <div>
                        <div class="font-serif text-4xl text-white leading-none">150<span class="text-terracotta-400">+</span></div>
                        <div class="text-[10px] uppercase tracking-[0.2em] text-stone-500 mt-2">Pengrajin</div>
                    </div>
                    <div class="w-px h-12 bg-stone-700"></div>
                    <div>
                        <div class="font-serif text-4xl text-white leading-none">200<span class="text-terracotta-400">+</span></div>
                        <div class="text-[10px] uppercase tracking-[0.2em] text-stone-500 mt-2">Produk</div>
                    </div>
                    <div class="w-px h-12 bg-stone-700"></div>
                    <div>
                        <div class="font-serif text-4xl text-white leading-none">70<span class="text-terracotta-400">+</span></div>
                        <div class="text-[10px] uppercase tracking-[0.2em] text-stone-500 mt-2">Tahun</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right: Login Form (shared desktop + mobile) --}}
        <div class="w-full lg:w-[48%] flex items-center justify-center px-6 md:px-12 py-12 min-h-screen bg-white">
            <div class="w-full max-w-[400px]">

                {{-- Header --}}
                <div class="mb-10">
                    <h1 class="font-serif text-3xl text-stone-900 mb-2.5">Selamat Datang</h1>
                    <p class="text-stone-400 font-light text-[15px]">Masuk ke panel admin untuk mengelola konten.</p>
                </div>

                {{-- Error --}}
                @if($errors->any())
                <div class="mb-6 flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-xl text-sm">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/></svg>
                    {{ $errors->first() }}
                </div>
                @endif

                {{-- Form --}}
                <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label for="email" class="text-[11px] uppercase tracking-[0.2em] text-stone-500 font-semibold block mb-2">Email</label>
                        <div class="relative">
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-[18px] h-[18px] text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                                class="w-full bg-stone-50 border border-stone-200 rounded-xl pl-12 pr-4 py-3.5 text-sm text-stone-900 placeholder:text-stone-400 outline-none focus:border-terracotta-500 focus:ring-2 focus:ring-terracotta-500/10 transition-all"
                                placeholder="admin@desadure.id">
                        </div>
                    </div>
                    <div>
                        <label for="password" class="text-[11px] uppercase tracking-[0.2em] text-stone-500 font-semibold block mb-2">Password</label>
                        <div class="relative">
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-[18px] h-[18px] text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            <input type="password" name="password" id="password" required
                                class="w-full bg-stone-50 border border-stone-200 rounded-xl pl-12 pr-4 py-3.5 text-sm text-stone-900 placeholder:text-stone-400 outline-none focus:border-terracotta-500 focus:ring-2 focus:ring-terracotta-500/10 transition-all"
                                placeholder="Masukkan password">
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-1">
                        <label class="flex items-center gap-2.5 cursor-pointer group">
                            <input type="checkbox" name="remember" class="w-4 h-4 rounded border-stone-300 text-terracotta-500 focus:ring-terracotta-500/20 focus:ring-offset-0">
                            <span class="text-sm text-stone-500 group-hover:text-stone-700 transition-colors">Ingat saya</span>
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full bg-terracotta-500 hover:bg-terracotta-600 text-white py-4 rounded-xl text-[11px] font-semibold uppercase tracking-[0.15em] transition-all duration-300 shadow-lg shadow-terracotta-500/25 hover:shadow-terracotta-600/30 flex items-center justify-center gap-2.5 mt-2">
                        <span>Masuk ke Dashboard</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </button>
                </form>

                <div class="mt-10 text-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-sm text-stone-400 hover:text-terracotta-600 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>

    </div>
</body>
</html>