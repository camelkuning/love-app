<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '💕 My Sweetheart')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Nunito:wght@400;600;700;800&family=Dancing+Script:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('styles')
</head>
<body>

    <!-- Floating hearts background -->
    <div class="hearts-bg" id="heartsBg"></div>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-brand">
            <span class="nav-logo">💝</span>
            <span class="nav-title">My Sweetheart</span>
        </div>
        <div class="nav-links">
            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                <span class="nav-icon">🏠</span> Home
            </a>
            <a href="{{ route('gallery') }}" class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}">
                <span class="nav-icon">🖼️</span> Gallery
            </a>
            {{-- <a href="{{ route('moments') }}" class="nav-link {{ request()->routeIs('moments') ? 'active' : '' }}">
                <span class="nav-icon">⭐</span> Moments
            </a> --}}
            <a href="{{ route('letter') }}" class="nav-link {{ request()->routeIs('letter') ? 'active' : '' }}">
                <span class="nav-icon">💌</span> Surat Cinta
            </a>
        </div>
        <div class="nav-hamburger" id="hamburger">
            <span></span><span></span><span></span>
        </div>
    </nav>

    <!-- Mobile menu -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="{{ route('home') }}" class="mobile-link">🏠 Home</a>
        <a href="{{ route('gallery') }}" class="mobile-link">🖼️ Gallery</a>
        {{-- <a href="{{ route('moments') }}" class="mobile-link">⭐ Moments</a> --}}
        <a href="{{ route('letter') }}" class="mobile-link">💌 Surat Cinta</a>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-inner">
            <p class="footer-text">Dibuat dengan <span class="heart-beat">💗</span> Untuk dirimu, Sayang</p>
            <p class="footer-sub">© {{ date('Y') }} — Olivia Liptiay ✨</p>
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
