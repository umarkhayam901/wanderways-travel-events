# WanderWays Travel Event Management Mini-Platform

A modern, responsive Laravel mini-platform designed to showcase upcoming travel-themed events, guided tours, and allow visitors to register for upcoming adventures.

---

## Project Overview

- **Client**: WanderWays Travel
- **Technology Stack**: Laravel 12 / PHP 8.4 / Blade / Mobile-First CSS / SQLite
- **Architecture**: Semantic HTML5, CSS Grid/Flexbox, Eloquent ORM, RESTful routing, Server-side validation

---

## Features Implemented

### Task 1: Responsive Homepage
- Semantic HTML5 structure (`<header>`, `<nav>`, `<main>`, `<footer>`).
- Mobile-first responsive layout with zero horizontal overflow across mobile (375px/390px), tablet (768px/820px), and desktop (1366px/1440px).
- Hero section introducing WanderWays with CTA to upcoming events.
- Service showcase highlighting curated cultural tours, mountain treks, and coastal retreats.
- Accessible navigation with WCAG focus indicators, skip-to-content link, and screen reader active page states.

### Task 2: Events Data Model & Paginated Listing
- **Event Eloquent Model**: `app/Models/Event.php` with mass assignment protection (`$fillable`) and date casting.
- **Database Schema**: `events` table with `id`, `title`, `description`, `location`, `event_date`, `event_time`, and timestamps.
- **Realistic Event Seeding**: 14 curated travel expeditions spanning historical walks, alpine trekking, and desert safaris.
- **EventController**: `app/Http/Controllers/EventController.php` with chronological ordering and Laravel pagination (6 events per page).
- **Responsive Events Page**: `resources/views/events/index.blade.php` displaying date badge, event title, location, time, description, and "Register for Event" CTA.
- **Accessible Pagination**: Semantic pagination controls supporting page navigation and query strings.
- **Empty State**: Friendly fallback card when no events are scheduled.

### Task 3: Event Registration with Validation & Storage
- **Registration Eloquent Model**: `app/Models/Registration.php` with `$fillable` configuration (`event_id`, `name`, `email`, `phone`).
- **Eloquent Relationships**:
  - `Event` &rarr; hasMany `Registration` (`$event->registrations`)
  - `Registration` &rarr; belongsTo `Event` (`$registration->event`)
- **Database Schema**: `registrations` table with foreign key constraint (`constrained('events')->cascadeOnDelete()`) and unique constraint `unique(['event_id', 'email'])`.
- **RegistrationController**:
  - `GET /register`: Displays visitor-friendly registration form with optional pre-selected event summary.
  - `POST /register`: Handles server-side validation, duplicate checks, database storage, and redirects with flash success confirmation.
- **Server-Side Validation**:
  - `event_id`: required, integer, exists in `events` table
  - `name`: required, string, max 100 characters
  - `email`: required, valid email format, max 150 characters
  - `phone`: optional, string, max 25 characters
- **Duplicate Prevention**: Prevents the same email address from registering multiple times for the same event, returning a friendly error message while preserving inputs.
- **Responsive Registration Form**: `resources/views/registrations/create.blade.php` styled with accessible labels, input validation feedback, touch-friendly buttons (53px height), and flash message banners.

---

## Database Setup & Seeding

1. **Run Migrations**:
   ```bash
   php artisan migrate
   ```

2. **Seed Realistic Travel Events**:
   ```bash
   php artisan db:seed
   ```

3. **Fresh Database with Seeds**:
   ```bash
   php artisan migrate:fresh --seed
   ```

---

## Running the Application

Start the local Laravel development server:
```bash
php artisan serve
```
- **Homepage**: [http://127.0.0.1:8000/](http://127.0.0.1:8000/)
- **Events Listing**: [http://127.0.0.1:8000/events](http://127.0.0.1:8000/events)
- **Events (Page 2)**: [http://127.0.0.1:8000/events?page=2](http://127.0.0.1:8000/events?page=2)
- **Registration Form**: [http://127.0.0.1:8000/register](http://127.0.0.1:8000/register)
- **Register for Specific Event**: [http://127.0.0.1:8000/register?event_id=1](http://127.0.0.1:8000/register?event_id=1)

---

## Running Tests

Execute the automated PHPUnit test suite:
```bash
php artisan test
```
All feature tests verify:
- Task 1 homepage and semantic HTML
- Task 2 database-driven event cards, pagination (page 1/2), and empty states
- Task 3 registration form, database storage, validation constraints, foreign key association, and duplicate prevention
