<nav id="navbar" class="fixed w-full z-50 transition-all duration-500 {{ $home ?? false ? 'bg-transparent py-6 lg:py-8' : 'bg-white/90 dark:bg-stone-900/90 backdrop-blur-xl shadow-[0_1px_0_0_rgba(0,0,0,0.06)] py-4' }}">
    <div class="max-w-7xl mx-auto px-5 md:px-8 lg:px-12 flex items-center justify-between">
        {{-- Logo --}}
        <a href="{{ route('home') }}" id="nav-logo" class="flex items-center gap-2 z-10">
            <div class="w-9 h-9 rounded-lg bg-terracotta-500/10 dark:bg-white/10 border border-terracotta-500/20 dark:border-white/20 flex items-center justify-center">
                <svg class="w-5 h-5 text-terracotta-600 dark:text-terracotta-400" viewBox="0 0 24 24" fill="currentColor"><path d="M3 21h1V7L12 3l8 4v14h1M7 21v-6a5 5 0 0 1 10 0v6M9 21v-5a3 3 0 0 1 6 0v5"/></svg>
            </div>
            <div class="leading-none">
                <span class="font-serif text-lg md:text-xl font-semibold tracking-tight">Desa Pengrajin</span>
                <span class="block text-[9px] uppercase tracking-[0.25em] text-stone-400 dark:text-stone-500 font-medium -mt-0.5">Genteng</span>
            </div>
        </a>

        {{-- Center Nav Links (desktop) --}}
        <div id="nav-links" class="hidden lg:flex items-center absolute left-1/2 -translate-x-1/2 gap-1">
            <a href="{{ route('home') }}" class="px-4 py-2 rounded-full text-[12px] font-medium tracking-wide transition-all duration-300 hover:bg-white/10">Beranda</a>
            <a href="{{ route('catalog') }}" class="px-4 py-2 rounded-full text-[12px] font-medium tracking-wide transition-all duration-300 hover:bg-white/10">Produk</a>
            <a href="{{ route('history') }}" class="px-4 py-2 rounded-full text-[12px] font-medium tracking-wide transition-all duration-300 hover:bg-white/10">Sejarah</a>
            <a href="{{ route('contact') }}" class="px-4 py-2 rounded-full text-[12px] font-medium tracking-wide transition-all duration-300 hover:bg-white/10">Kontak</a>
        </div>

        {{-- Right: Theme Toggle + CTA + Mobile --}}
        <div class="flex items-center gap-3 z-10">
            <button id="theme-toggle" class="p-2 rounded-full transition-all duration-300" aria-label="Toggle dark mode">
                <svg id="theme-icon-sun" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <svg id="theme-icon-moon" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 12c0 5.385 4.365 9.75 9.75 9.75.933 0 1.834-.131 2.687-.375 1.154-.317 2.105-1.104 3.315-1.623z" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <a href="{{ route('contact') }}" id="nav-cta" class="hidden md:inline-flex items-center gap-2 bg-terracotta-500 hover:bg-terracotta-600 text-white px-5 py-2.5 rounded-full text-[11px] font-semibold uppercase tracking-[0.15em] transition-all duration-300 shadow-lg shadow-terracotta-500/20">
                <span>Kontak</span>
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
            <button id="mobile-menu-btn" class="lg:hidden p-2" aria-label="Buka menu navigasi">
                <svg class="w-6 h-6 block" id="menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg class="w-6 h-6 hidden" id="close-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="hidden absolute top-full left-0 w-full bg-white/95 dark:bg-stone-900/95 backdrop-blur-xl border-t border-stone-100 dark:border-stone-800 p-6 flex flex-col space-y-2 lg:hidden shadow-xl rounded-b-2xl" aria-hidden="true">
        <a href="{{ route('home') }}" class="text-left font-serif text-lg text-stone-900 dark:text-white hover:text-terracotta-600 dark:hover:text-terracotta-400 transition-colors py-3 px-3 rounded-lg hover:bg-stone-50 dark:hover:bg-stone-800/50">Beranda</a>
        <a href="{{ route('catalog') }}" class="text-left font-serif text-lg text-stone-900 dark:text-white hover:text-terracotta-600 dark:hover:text-terracotta-400 transition-colors py-3 px-3 rounded-lg hover:bg-stone-50 dark:hover:bg-stone-800/50">Produk</a>
        <a href="{{ route('history') }}" class="text-left font-serif text-lg text-stone-900 dark:text-white hover:text-terracotta-600 dark:hover:text-terracotta-400 transition-colors py-3 px-3 rounded-lg hover:bg-stone-50 dark:hover:bg-stone-800/50">Sejarah</a>
        <a href="{{ route('contact') }}" class="text-left font-serif text-lg text-stone-900 dark:text-white hover:text-terracotta-600 dark:hover:text-terracotta-400 transition-colors py-3 px-3 rounded-lg hover:bg-stone-50 dark:hover:bg-stone-800/50">Kontak</a>
        <a href="{{ route('contact') }}" class="inline-flex items-center justify-center gap-2 bg-terracotta-500 hover:bg-terracotta-600 text-white px-6 py-3.5 rounded-full text-sm font-semibold uppercase tracking-wider transition-all mt-3">
            Kontak
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
    </div>
</nav>

<script>
    var themeToggle = document.getElementById('theme-toggle');
    var sunIcon = document.getElementById('theme-icon-sun');
    var moonIcon = document.getElementById('theme-icon-moon');

    function applyNavColors() {
        var isDark = document.documentElement.classList.contains('dark');
        var nav = document.getElementById('navbar');
        var logo = document.getElementById('nav-logo');
        var links = document.getElementById('nav-links');
        var isHomeTransparent = nav && nav.classList.contains('bg-transparent');

        if (isHomeTransparent) {
            if (isDark) {
                logo.classList.add('text-stone-900');
                logo.classList.remove('text-white');
                links.classList.add('text-stone-800/80');
                links.classList.remove('text-white/70');
                if (sunIcon) sunIcon.classList.remove('hidden');
                if (moonIcon) moonIcon.classList.add('hidden');
            } else {
                logo.classList.add('text-white');
                logo.classList.remove('text-stone-900');
                links.classList.add('text-white/70');
                links.classList.remove('text-stone-800/80');
                if (sunIcon) sunIcon.classList.add('hidden');
                if (moonIcon) moonIcon.classList.remove('hidden');
            }
        }
    }

    applyNavColors();

    themeToggle.addEventListener('click', function() {
        document.documentElement.classList.toggle('dark');
        localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
        applyNavColors();
    });

    var mobileMenuBtn = document.getElementById('mobile-menu-btn');
    var mobileMenu = document.getElementById('mobile-menu');
    var menuIcon = document.getElementById('menu-icon');
    var closeIcon = document.getElementById('close-icon');

    mobileMenuBtn.addEventListener('click', function() {
        var isHidden = !mobileMenu.classList.contains('show');
        mobileMenu.classList.toggle('hidden');
        mobileMenu.classList.toggle('show');
        menuIcon.classList.toggle('hidden');
        closeIcon.classList.toggle('hidden');
        mobileMenu.setAttribute('aria-hidden', isHidden ? 'true' : 'false');
    });

    @if($home ?? false)
    window.addEventListener('scroll', function() {
        var nav = document.getElementById('navbar');
        var logo = document.getElementById('nav-logo');
        var links = document.getElementById('nav-links');
        var navCta = document.getElementById('nav-cta');
        var isDark = document.documentElement.classList.contains('dark');

        if (window.scrollY > 80) {
            nav.classList.remove('bg-transparent', 'py-6', 'lg:py-8');
            nav.classList.add(isDark ? 'bg-stone-900/90' : 'bg-white/90', 'backdrop-blur-xl', 'shadow-[0_1px_0_0_rgba(0,0,0,0.06)]', 'py-4');
            logo.classList.remove('text-white', 'text-stone-900');
            logo.classList.add(isDark ? 'text-white' : 'text-stone-900');
            links.classList.remove('text-white/70', 'text-stone-800/80');
            links.classList.add(isDark ? 'text-stone-300' : 'text-stone-600');
            if (navCta) {
                navCta.classList.remove('bg-white', 'text-stone-900', 'hover:bg-white/90');
                navCta.classList.add('bg-terracotta-500', 'hover:bg-terracotta-600', 'text-white');
            }
        } else {
            nav.classList.add('bg-transparent', 'py-6', 'lg:py-8');
            nav.classList.remove(isDark ? 'bg-stone-900/90' : 'bg-white/90', 'backdrop-blur-xl', 'shadow-[0_1px_0_0_rgba(0,0,0,0.06)]', 'py-4');
            if (navCta) {
                navCta.classList.add('bg-white', 'text-stone-900', 'hover:bg-white/90');
                navCta.classList.remove('bg-terracotta-500', 'hover:bg-terracotta-600', 'text-white');
            }
        }
        applyNavColors();
    });
    @endif
</script>