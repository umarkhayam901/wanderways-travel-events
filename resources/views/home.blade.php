@extends('layouts.app')

@section('title', 'WanderWays Travel | Discover Travel-Themed Events & Group Expeditions')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section" aria-labelledby="hero-heading">
        <div class="site-container">
            <div class="hero-grid">
                <!-- Hero Text Content -->
                <div class="hero-content">
                    <span class="section-tag">
                        <span>✈️</span> Travel Event Management Hub
                    </span>
                    <h1 id="hero-heading" class="hero-title">
                        Discover Unique <span class="hero-title__highlight">Travel Events</span> Around You
                    </h1>
                    <p class="hero-description">
                        Welcome to WanderWays Travel! We connect passionate explorers with exciting upcoming travel-themed events, guided adventures, and community expeditions. Find your next experience or connect with fellow globetrotters.
                    </p>
                    <div class="hero-actions">
                        <a href="{{ route('events.index') }}" class="btn btn--primary btn--lg">
                            <span>Explore Upcoming Events</span>
                            <span aria-hidden="true">&rarr;</span>
                        </a>
                        <a href="#services" class="btn btn--secondary btn--lg">
                            <span>Learn More</span>
                        </a>
                    </div>
                </div>

                <!-- Hero Visual Showcase Card -->
                <div class="hero-visual">
                    <div class="hero-card">
                        <div class="hero-card__header">
                            <span class="hero-card__badge">Featured Event Spotlight</span>
                            <span class="hero-card__status">Accepting Visitors</span>
                        </div>
                        <h2 class="hero-card__title">Alpine Ridge Summit &amp; Photography Tour</h2>
                        <div class="hero-card__meta">
                            <span>📍 Northern Mountain Valley</span>
                            <span>🗓️ 3-Day Guided Event &bull; Small Group</span>
                        </div>
                        <p style="font-size: 0.9rem; color: var(--color-text-muted); line-height: 1.5; margin-bottom: 1rem;">
                            Join seasoned tour leaders and fellow nature lovers on a scenic mountain hike with photography workshops and fireside storytelling.
                        </p>
                        <div class="hero-card__stats">
                            <div>
                                <div class="hero-card__stat-value">18</div>
                                <div class="hero-card__stat-label">Spots Total</div>
                            </div>
                            <div>
                                <div class="hero-card__stat-value">6</div>
                                <div class="hero-card__stat-label">Remaining</div>
                            </div>
                            <div>
                                <div class="hero-card__stat-value">4.9★</div>
                                <div class="hero-card__stat-label">Rating</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Overview Section -->
    <section id="services" class="service-section" aria-labelledby="services-heading">
        <div class="site-container">
            <div class="section-header">
                <span class="section-tag">What WanderWays Offers</span>
                <h2 id="services-heading" class="section-title">Discover Curated Travel Experiences</h2>
                <p class="section-subtitle">
                    WanderWays is a specialized travel-event platform designed to help visitors discover, explore, and participate in curated travel-themed events hosted by verified guides and community groups.
                </p>
            </div>

            <div class="service-grid">
                <!-- Service 1 -->
                <article class="service-card">
                    <div class="service-card__icon-box">
                        <span aria-hidden="true">🗺️</span>
                    </div>
                    <h3 class="service-card__title">Cultural &amp; Heritage Walks</h3>
                    <p class="service-card__description">
                        Immerse yourself in historic quarters, vibrant artisan quarters, and local culinary traditions with knowledgeable cultural storytellers.
                    </p>
                    <a href="{{ route('events.index') }}" class="service-card__link">
                        <span>Browse Cultural Events</span>
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                </article>

                <!-- Service 2 -->
                <article class="service-card">
                    <div class="service-card__icon-box service-card__icon-box--accent">
                        <span aria-hidden="true">🧗‍♂️</span>
                    </div>
                    <h3 class="service-card__title">Mountain &amp; Trail Treks</h3>
                    <p class="service-card__description">
                        From beginner-friendly nature hikes to challenging alpine ridges, discover guided group expeditions that prioritize safety and camaraderie.
                    </p>
                    <a href="{{ route('events.index') }}" class="service-card__link">
                        <span>Browse Trekking Events</span>
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                </article>

                <!-- Service 3 -->
                <article class="service-card">
                    <div class="service-card__icon-box service-card__icon-box--primary">
                        <span aria-hidden="true">🌊</span>
                    </div>
                    <h3 class="service-card__title">Coastal &amp; Nature Retreats</h3>
                    <p class="service-card__description">
                        Unwind with weekend coastal camping trips, marine wildlife observation, and relaxing nature retreats crafted for rejuvenation.
                    </p>
                    <a href="{{ route('events.index') }}" class="service-card__link">
                        <span>Browse Nature Escapes</span>
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                </article>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="about" class="how-it-works-section" aria-labelledby="how-heading">
        <div class="site-container">
            <div class="section-header">
                <span class="section-tag">Simple &amp; Accessible</span>
                <h2 id="how-heading" class="section-title">How WanderWays Works</h2>
                <p class="section-subtitle">
                    Planning your next travel adventure has never been simpler. Here is how our platform helps you get out and explore.
                </p>
            </div>

            <div class="steps-grid">
                <div class="step-card">
                    <div class="step-card__number">1</div>
                    <div class="step-card__content">
                        <h3>Discover Events</h3>
                        <p>Search our public listings for upcoming travel events categorized by destination, theme, and activity level.</p>
                    </div>
                </div>

                <div class="step-card">
                    <div class="step-card__number">2</div>
                    <div class="step-card__content">
                        <h3>Review Itineraries</h3>
                        <p>Inspect detailed schedules, group sizes, gear requirements, and organizer notes before making a decision.</p>
                    </div>
                </div>

                <div class="step-card">
                    <div class="step-card__number">3</div>
                    <div class="step-card__content">
                        <h3>Join The Adventure</h3>
                        <p>Secure your spot, receive event updates, and embark on memorable travel journeys with fellow explorers.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section Leading to Events -->
    <section class="cta-section" aria-label="Join an event">
        <div class="site-container">
            <div class="cta-banner">
                <h2 class="cta-banner__title">Ready for Your Next Travel Adventure?</h2>
                <p class="cta-banner__description">
                    Explore our upcoming schedule of travel-themed gatherings, seasonal road trips, and guided tours. Spaces fill quickly!
                </p>
                <div class="cta-banner__actions">
                    <a href="{{ route('events.index') }}" class="btn btn--primary btn--lg">
                        <span>View All Events Schedule</span>
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
