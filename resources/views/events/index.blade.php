@extends('layouts.app')

@section('title', 'Upcoming Travel Events | WanderWays Travel')

@section('content')
    <section class="events-page-section" aria-labelledby="events-page-heading">
        <div class="site-container">
            <!-- Page Header -->
            <div class="events-header">
                <span class="section-tag">
                    <span>🧭</span> Discover &amp; Join
                </span>
                <h1 id="events-page-heading" class="events-header__title">Upcoming Travel Events</h1>
                <p class="events-header__subtitle">
                    Explore our curated schedule of guided adventures, cultural expeditions, and nature getaways. Select an event to join fellow explorers.
                </p>

                @if ($events->total() > 0)
                    <div class="events-header__meta">
                        <span class="events-count-badge">
                            Showing {{ $events->firstItem() }}&ndash;{{ $events->lastItem() }} of {{ $events->total() }} Upcoming Events
                        </span>
                    </div>
                @endif
            </div>

            <!-- Events Grid -->
            <div class="events-grid">
                @forelse ($events as $event)
                    <article class="event-card" aria-labelledby="event-title-{{ $event->id }}">
                        <div class="event-card__top">
                            <div class="event-card__date-badge">
                                <span class="event-card__date-month">{{ $event->event_date->format('M') }}</span>
                                <span class="event-card__date-day">{{ $event->event_date->format('d') }}</span>
                                <span class="event-card__date-year">{{ $event->event_date->format('Y') }}</span>
                            </div>
                            <span class="event-card__status-tag">Upcoming</span>
                        </div>

                        <div class="event-card__body">
                            <h2 id="event-title-{{ $event->id }}" class="event-card__title">
                                {{ $event->title }}
                            </h2>

                            <div class="event-card__details">
                                <div class="event-card__detail-item">
                                    <span class="event-card__detail-icon" aria-hidden="true">📍</span>
                                    <span>{{ $event->location }}</span>
                                </div>
                                @if ($event->event_time)
                                    <div class="event-card__detail-item">
                                        <span class="event-card__detail-icon" aria-hidden="true">⏰</span>
                                        <span>{{ \Carbon\Carbon::parse($event->event_time)->format('h:i A') }}</span>
                                    </div>
                                @endif
                            </div>

                            <p class="event-card__description">
                                {{ Str::limit($event->description, 140) }}
                            </p>
                        </div>

                        <div class="event-card__footer">
                            <a href="{{ Route::has('registrations.create') ? route('registrations.create', ['event_id' => $event->id]) : url('/register?event_id=' . $event->id) }}"
                               class="btn btn--primary btn--sm event-card__cta"
                               aria-label="Register for {{ $event->title }}">
                                <span>Register for Event</span>
                                <span aria-hidden="true">&rarr;</span>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="events-empty-card">
                        <div class="events-empty-card__icon" aria-hidden="true">🗺️</div>
                        <h2 class="events-empty-card__title">No Upcoming Events Found</h2>
                        <p class="events-empty-card__desc">
                            We currently do not have any scheduled travel events in this list. Please check back soon or return to the homepage to explore our travel services.
                        </p>
                        <a href="{{ route('home') }}" class="btn btn--secondary">
                            &larr; Back to Homepage
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination Controls -->
            <div class="events-pagination-container">
                {{ $events->links('partials.pagination') }}
            </div>
        </div>
    </section>
@endsection
