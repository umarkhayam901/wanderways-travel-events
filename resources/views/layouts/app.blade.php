<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="WanderWays Travel - Discover upcoming travel-themed events, guided tours, and unforgettable cultural adventures.">
    <title>@yield('title', 'WanderWays Travel - Discover Upcoming Travel Events')</title>

    <!-- External Custom Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/wanderways.css') }}">
</head>
<body>
    <!-- Accessibility Skip Link -->
    <a href="#main-content" class="skip-link">Skip to main content</a>

    <!-- Semantic Header -->
    <header class="site-header">
        <div class="site-container">
            <div class="site-header__inner">
                <a href="{{ route('home') }}" class="site-brand" aria-label="WanderWays Travel Home">
                    <span class="site-brand__icon">🧭</span>
                    <span>Wander<span class="site-brand__highlight">Ways</span></span>
                </a>

                <!-- Semantic Navigation -->
                <nav class="site-nav" aria-label="Primary Navigation">
                    <ul class="site-nav__list">
                        <li>
                            <a href="{{ route('home') }}" class="site-nav__link {{ request()->routeIs('home') ? 'site-nav__link--active' : '' }}" {!! request()->routeIs('home') ? 'aria-current="page"' : '' !!}>
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('events.index') }}" class="site-nav__link {{ request()->routeIs('events.*') ? 'site-nav__link--active' : '' }}" {!! request()->routeIs('events.*') ? 'aria-current="page"' : '' !!}>
                                Events
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home') }}#services" class="site-nav__link">
                                Services
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home') }}#about" class="site-nav__link">
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('events.index') }}" class="site-nav__link site-nav__cta">
                                Browse Events
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Semantic Main Content -->
    <main class="main-content" id="main-content">
        @yield('content')
    </main>

    <!-- Semantic Footer -->
    <footer class="site-footer">
        <div class="site-container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <div class="footer-brand__logo">
                        <span>🧭</span>
                        <span>WanderWays Travel</span>
                    </div>
                    <p class="footer-brand__description">
                        Connecting adventurous travelers with curated travel-themed events, local culture tours, hiking expeditions, and weekend getaways.
                    </p>
                </div>

                <div class="footer-nav">
                    <h4 class="footer-nav__title">Navigation</h4>
                    <ul class="footer-nav__list">
                        <li><a href="{{ route('home') }}" class="footer-nav__link">Home</a></li>
                        <li><a href="{{ route('events.index') }}" class="footer-nav__link">Events</a></li>
                        <li><a href="{{ route('home') }}#services" class="footer-nav__link">Services</a></li>
                        <li><a href="{{ route('home') }}#about" class="footer-nav__link">About Us</a></li>
                    </ul>
                </div>

                <div class="footer-nav">
                    <h4 class="footer-nav__title">Discover</h4>
                    <ul class="footer-nav__list">
                        <li><a href="{{ route('events.index') }}" class="footer-nav__link">Upcoming Trips</a></li>
                        <li><a href="{{ route('events.index') }}" class="footer-nav__link">Cultural Tours</a></li>
                        <li><a href="{{ route('events.index') }}" class="footer-nav__link">Mountain Treks</a></li>
                        <li><a href="{{ route('events.index') }}" class="footer-nav__link">Nature Escapes</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} WanderWays Travel Event Management. All rights reserved.</p>
                <p>Designed for memorable journeys &amp; shared adventures.</p>
            </div>
        </div>
    </footer>
</body>
</html>
