# WanderWays Travel Event Management Mini-Platform

A modern, responsive Laravel mini-platform designed to showcase upcoming travel-themed events, guided tours, and community expeditions.

---

## Project Overview

- **Client**: WanderWays Travel
- **Technology Stack**: Laravel 12 / PHP 8.4 / Blade / Mobile-First CSS / SQLite
- **Architecture**: Semantic HTML5, CSS Grid/Flexbox, Eloquent ORM, RESTful routing

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

---

## Running Tests

Execute the automated PHPUnit test suite:
```bash
php artisan test
```
All feature tests verify HTTP responses, database rendering, pagination links, empty states, and semantic HTML elements.
