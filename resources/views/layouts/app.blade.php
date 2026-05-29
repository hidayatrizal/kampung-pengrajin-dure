<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Beranda') — Desa Pengrajin Genteng</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="preload" as="image" href="/hero.webp" type="image/webp" fetchpriority="high">
    <link rel="preload" as="image" href="/hero.png" fetchpriority="high">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-serif { font-family: 'Cormorant Garamond', Georgia, serif; }
    </style>
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>
<body class="min-h-screen bg-cream-50 dark:bg-stone-950 text-stone-900 dark:text-stone-100 selection:bg-terracotta-500 selection:text-white transition-colors duration-300">
    @yield('content')
    @stack('scripts')

    @unless(isset($noFooter) && $noFooter)
        @include('components.footer')
    @endunless

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var fadeElements = document.querySelectorAll('.fade-in');
            var revealLines = document.querySelectorAll('.reveal-line');
            var imgReveals = document.querySelectorAll('.img-reveal');

            var observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.05, rootMargin: '0px 0px -50px 0px' });

            fadeElements.forEach(function(el) { observer.observe(el); });
            revealLines.forEach(function(el) { observer.observe(el); });
            imgReveals.forEach(function(el) { observer.observe(el); });

            var heroSection = document.querySelector('.hero-section');
            if (heroSection) {
                var heroFadeIns = heroSection.querySelectorAll('.fade-in');
                heroFadeIns.forEach(function(el) { el.classList.add('visible'); });
            }

            setTimeout(function() {
                document.querySelectorAll('.img-reveal').forEach(function(el) {
                    var rect = el.getBoundingClientRect();
                    if (rect.top < window.innerHeight && rect.bottom > 0) {
                        el.classList.add('visible');
                    }
                });
            }, 300);
        });
    </script>
</body>
</html>