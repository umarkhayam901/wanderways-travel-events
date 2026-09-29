@extends('layouts.app')

@section('title', 'Registration Confirmed | WanderWays Travel')

@section('content')
    <section class="registration-page-section" aria-labelledby="confirmation-heading">
        <div class="site-container">
            <div class="registration-wrapper">
                <!-- Navigation Link -->
                <div class="registration-back-nav">
                    <a href="{{ route('events.index') }}" class="back-link">
                        <span aria-hidden="true">&larr;</span>
                        <span>Back to Upcoming Events</span>
                    </a>
                </div>

                <!-- Flash Success Banner -->
                @if (session('success'))
                    <div class="alert alert--success" role="alert">
                        <div class="alert__icon" aria-hidden="true">✅</div>
                        <div class="alert__content">
                            <h3 class="alert__title">Registration Successful!</h3>
                            <p class="alert__message">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <!-- Confirmation Card -->
                <article class="registration-card confirmation-card">
                    <div class="confirmation-card__header">
                        <div class="confirmation-card__icon" aria-hidden="true">🎉</div>
                        <span class="section-tag">
                            <span>✅</span> Confirmed Booking #REG-{{ str_pad($registration->id, 5, '0', STR_PAD_LEFT) }}
                        </span>
                        <h1 id="confirmation-heading" class="confirmation-card__title">
                            Registration Confirmed!
                        </h1>
                        <p class="confirmation-card__subtitle">
                            Thank you, <strong>{{ $registration->name }}</strong>! Your spot has been successfully reserved. We are excited to welcome you on this adventure.
                        </p>
                    </div>

                    <!-- Highlighted Event Information Card -->
                    <div class="confirmation-details-grid">
                        <div class="confirmation-section confirmation-section--event">
                            <h2 class="confirmation-section__title">
                                <span aria-hidden="true">🧭</span> Travel Event Details
                            </h2>
                            <div class="confirmation-event-card">
                                <h3 class="confirmation-event-card__title">{{ $registration->event->title }}</h3>
                                <div class="confirmation-event-card__meta">
                                    <div class="confirmation-meta-item">
                                        <span class="confirmation-meta-icon" aria-hidden="true">📍</span>
                                        <div>
                                            <span class="confirmation-meta-label">Location:</span>
                                            <span class="confirmation-meta-value">{{ $registration->event->location }}</span>
                                        </div>
                                    </div>
                                    <div class="confirmation-meta-item">
                                        <span class="confirmation-meta-icon" aria-hidden="true">🗓️</span>
                                        <div>
                                            <span class="confirmation-meta-label">Date:</span>
                                            <span class="confirmation-meta-value">{{ $registration->event->event_date->format('l, F j, Y') }}</span>
                                        </div>
                                    </div>
                                    @if ($registration->event->event_time)
                                        <div class="confirmation-meta-item">
                                            <span class="confirmation-meta-icon" aria-hidden="true">⏰</span>
                                            <div>
                                                <span class="confirmation-meta-label">Departure Time:</span>
                                                <span class="confirmation-meta-value">{{ \Carbon\Carbon::parse($registration->event->event_time)->format('h:i A') }}</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <p class="confirmation-event-card__desc">
                                    {{ $registration->event->description }}
                                </p>
                            </div>
                        </div>

                        <!-- Attendee Information Card -->
                        <div class="confirmation-section confirmation-section--attendee">
                            <h2 class="confirmation-section__title">
                                <span aria-hidden="true">👤</span> Registered Attendee Details
                            </h2>
                            <div class="confirmation-attendee-card">
                                <ul class="confirmation-list">
                                    <li class="confirmation-list-item">
                                        <span class="confirmation-list-label">Full Name</span>
                                        <span class="confirmation-list-value">{{ $registration->name }}</span>
                                    </li>
                                    <li class="confirmation-list-item">
                                        <span class="confirmation-list-label">Email Address</span>
                                        <span class="confirmation-list-value">{{ $registration->email }}</span>
                                    </li>
                                    <li class="confirmation-list-item">
                                        <span class="confirmation-list-label">Booking Reference</span>
                                        <span class="confirmation-list-value badge badge--success">
                                            #REG-{{ str_pad($registration->id, 5, '0', STR_PAD_LEFT) }}
                                        </span>
                                    </li>
                                    <li class="confirmation-list-item">
                                        <span class="confirmation-list-label">Registration Date</span>
                                        <span class="confirmation-list-value">
                                            {{ $registration->created_at->format('M d, Y \a\t h:i A') }}
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Helpful Notice -->
                    <div class="confirmation-notice">
                        <span class="confirmation-notice__icon" aria-hidden="true">ℹ️</span>
                        <p class="confirmation-notice__text">
                            A confirmation notice has been logged for this event. Please arrive 15 minutes before the scheduled time with valid photo identification.
                        </p>
                    </div>

                    <!-- Action CTAs -->
                    <div class="confirmation-actions">
                        <a href="{{ route('events.index') }}" class="btn btn--primary btn--lg">
                            <span>Browse More Events</span>
                            <span aria-hidden="true">&rarr;</span>
                        </a>
                        <a href="{{ route('registrations.create', ['event_id' => $registration->event_id]) }}" class="btn btn--secondary">
                            <span>Register Another Attendee</span>
                        </a>
                        <a href="{{ route('home') }}" class="btn btn--secondary">
                            <span>Back to Homepage</span>
                        </a>
                    </div>
                </article>
            </div>
        </div>
    </section>
@endsection
