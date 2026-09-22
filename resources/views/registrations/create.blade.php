@extends('layouts.app')

@section('title', 'Event Registration | WanderWays Travel')

@section('content')
    <section class="registration-page-section" aria-labelledby="registration-heading">
        <div class="site-container">
            <div class="registration-wrapper">
                <!-- Page Breadcrumb / Back Link -->
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

                <!-- Validation Errors Alert -->
                @if ($errors->any())
                    <div class="alert alert--danger" role="alert">
                        <div class="alert__icon" aria-hidden="true">⚠️</div>
                        <div class="alert__content">
                            <h3 class="alert__title">Please Correct the Errors Below</h3>
                            <ul class="alert__list">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <!-- Registration Card -->
                <div class="registration-card">
                    <div class="registration-card__header">
                        <span class="section-tag">
                            <span>🎫</span> Reserve Your Spot
                        </span>
                        <h1 id="registration-heading" class="registration-card__title">
                            Join an Upcoming Travel Event
                        </h1>
                        <p class="registration-card__subtitle">
                            Fill out the registration details below to reserve your place on one of WanderWays curated travel adventures.
                        </p>
                    </div>

                    <!-- Selected Event Highlight (if pre-selected) -->
                    @if ($selectedEvent)
                        <div class="selected-event-card">
                            <div class="selected-event-card__badge">Selected Adventure</div>
                            <h2 class="selected-event-card__title">{{ $selectedEvent->title }}</h2>
                            <div class="selected-event-card__meta">
                                <span>📍 {{ $selectedEvent->location }}</span>
                                <span>🗓️ {{ $selectedEvent->event_date->format('M d, Y') }}</span>
                                @if ($selectedEvent->event_time)
                                    <span>⏰ {{ \Carbon\Carbon::parse($selectedEvent->event_time)->format('h:i A') }}</span>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Registration Form -->
                    <form action="{{ route('registrations.store') }}" method="POST" class="registration-form" novalidate>
                        @csrf

                        <!-- Event Selection Field -->
                        <div class="form-group @error('event_id') form-group--error @enderror">
                            <label for="event_id" class="form-label">
                                Select Travel Event <span class="form-required" aria-hidden="true">*</span>
                            </label>
                            <select id="event_id"
                                    name="event_id"
                                    class="form-select @error('event_id') form-control--invalid @enderror"
                                    required
                                    aria-describedby="@error('event_id') event-error @enderror">
                                <option value="" disabled {{ !old('event_id', optional($selectedEvent)->id) ? 'selected' : '' }}>
                                    -- Choose an Upcoming Travel Event --
                                </option>
                                @foreach ($events as $ev)
                                    <option value="{{ $ev->id }}" {{ (string) old('event_id', optional($selectedEvent)->id) === (string) $ev->id ? 'selected' : '' }}>
                                        {{ $ev->title }} ({{ $ev->event_date->format('M d, Y') }} - {{ $ev->location }})
                                    </option>
                                @endforeach
                            </select>
                            @error('event_id')
                                <p id="event-error" class="form-error" role="alert">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Full Name Field -->
                        <div class="form-group @error('name') form-group--error @enderror">
                            <label for="name" class="form-label">
                                Full Name <span class="form-required" aria-hidden="true">*</span>
                            </label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   class="form-input @error('name') form-control--invalid @enderror"
                                   value="{{ old('name') }}"
                                   placeholder="e.g. Umar Khayam"
                                   required
                                   maxlength="100"
                                   aria-describedby="@error('name') name-error @enderror">
                            @error('name')
                                <p id="name-error" class="form-error" role="alert">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email Address Field -->
                        <div class="form-group @error('email') form-group--error @enderror">
                            <label for="email" class="form-label">
                                Email Address <span class="form-required" aria-hidden="true">*</span>
                            </label>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   class="form-input @error('email') form-control--invalid @enderror"
                                   value="{{ old('email') }}"
                                   placeholder="e.g. traveler@example.com"
                                   required
                                   maxlength="150"
                                   aria-describedby="@error('email') email-error @enderror">
                            @error('email')
                                <p id="email-error" class="form-error" role="alert">{{ $message }}</p>
                            @enderror
                            <span class="form-help">Each email can only register once per travel event.</span>
                        </div>

                        <!-- Phone Number Field (Optional) -->
                        <div class="form-group @error('phone') form-group--error @enderror">
                            <label for="phone" class="form-label">
                                Phone Number <span class="form-optional">(Optional)</span>
                            </label>
                            <input type="tel"
                                   id="phone"
                                   name="phone"
                                   class="form-input @error('phone') form-control--invalid @enderror"
                                   value="{{ old('phone') }}"
                                   placeholder="e.g. +92 300 1234567"
                                   maxlength="25"
                                   aria-describedby="@error('phone') phone-error @enderror">
                            @error('phone')
                                <p id="phone-error" class="form-error" role="alert">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Form Submit Actions -->
                        <div class="form-actions">
                            <button type="submit" class="btn btn--primary btn--lg btn--block">
                                <span>Confirm &amp; Register for Event</span>
                                <span aria-hidden="true">&rarr;</span>
                            </button>
                            <a href="{{ route('events.index') }}" class="btn btn--secondary btn--block">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
