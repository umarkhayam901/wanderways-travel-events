@extends('layouts.app')

@section('title', 'Upcoming Events | WanderWays Travel')

@section('content')
    <section class="events-placeholder-section" aria-labelledby="events-heading">
        <div class="site-container">
            <div class="events-placeholder-card">
                <div class="events-placeholder-card__icon" aria-hidden="true">
                    📅
                </div>
                <h1 id="events-heading" class="events-placeholder-card__title">Upcoming Travel Events</h1>
                <p class="events-placeholder-card__desc">
                    Discover upcoming travel-themed events, weekend getaways, and guided group expeditions.
                </p>

                <div class="events-placeholder-card__notice">
                    <strong>Notice:</strong> The full events data listing and pagination are currently scheduled for <em>Task 2</em>. This placeholder satisfies the Task 1 requirement for the "Events" navigation link and route.
                </div>

                <div style="display: flex; gap: 0.75rem; justify-content: center; flex-wrap: wrap;">
                    <a href="{{ route('home') }}" class="btn btn--secondary">
                        <span aria-hidden="true">&larr;</span>
                        <span>Back to Homepage</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
