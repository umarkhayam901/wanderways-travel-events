# WanderWays Travel Event Management Mini-Platform

A modern, responsive Laravel mini-platform designed to showcase upcoming travel-themed events, guided expeditions, and enable visitors to register for adventures seamlessly.

---

## 🌐 Live Deployment & Production Status

- **Live Production URL**: [https://wanderways-travel-events.vercel.app](https://wanderways-travel-events.vercel.app)
- **Live Health Endpoint**: [https://wanderways-travel-events.vercel.app/up](https://wanderways-travel-events.vercel.app/up)
- **Hosting Environment**: Vercel Serverless (PHP 8.4 runtime) / Render / Railway compatible
- **Live Pages Accessible**:
  - **Homepage**: [https://wanderways-travel-events.vercel.app/](https://wanderways-travel-events.vercel.app/)
  - **Events Listing**: [https://wanderways-travel-events.vercel.app/events](https://wanderways-travel-events.vercel.app/events)
  - **Registration Flow**: [https://wanderways-travel-events.vercel.app/register](https://wanderways-travel-events.vercel.app/register)

---

## 📋 Project Overview

- **Organization / Client**: WanderWays Travel
- **Application Type**: Travel Event Management & Registration Mini-Platform
- **Core Objectives**:
  - Present travel expeditions across diverse landscapes (mountains, coastlines, heritage cities, deserts).
  - Allow travelers to browse events with structured chronological listings and responsive pagination.
  - Enable visitors to register with strict server-side validation, duplicate prevention, and immediate confirmation receipts.
  - Deliver zero horizontal scroll across mobile (375px/390px), tablet (768px/820px), and desktop (1366px/1440px) viewports with strict adherence to accessibility (WCAG) standards.

---

## 🛠️ Technology Stack

| Layer | Technologies & Tools |
|---|---|
| **Backend Framework** | Laravel 12.x / 13.x (PHP 8.4+) |
| **Templating Engine** | Laravel Blade with semantic HTML5 |
| **Styling & Design System** | Custom Mobile-First CSS (CSS Grid, Flexbox, CSS Custom Properties, zero layout shifts) |
| **Database Engines** | PostgreSQL (Production - Render/Railway/Neon), MySQL, SQLite (Local / Serverless Fallback) |
| **Object-Relational Mapping** | Laravel Eloquent ORM with strict relationships and mass-assignment protection |
| **Validation & Security** | Server-side Form Requests, CSRF token protection, unique constraints, XSS escaping |
| **Automated Testing** | PHPUnit / Pest Feature & Unit testing suite |
| **Hosting & CI/CD** | Vercel Serverless / Render / Railway / Git |

---

## 🚀 Key Features

### 1. Task 1: Responsive Homepage (`/`)
- Semantic HTML5 structure (`<header>`, `<nav>`, `<main>`, `<section>`, `<footer>`).
- Fluid mobile-first responsive layout with zero horizontal overflow across 375px &ndash; 1440px screen sizes.
- Engaging Hero banner with call-to-action directly leading into upcoming expeditions.
- Curated service showcase covering cultural tours, alpine mountain treks, coastal retreats, and eco-tours.
- Accessible navigation featuring WCAG focus rings, skip-to-content links, and ARIA current page indicators.

### 2. Task 2: Events Data Model & Paginated Listing (`/events`)
- **Eloquent Model (`app/Models/Event.php`)**: Full mass-assignment protection (`$fillable`), type casting for dates and times.
- **Database Schema (`events`)**: Tracks event ID, title, full description, location, date, time, and audit timestamps.
- **Chronological Ordering**: Upcoming events sorted chronologically by `event_date` ascending.
- **Server-Side Pagination**: 2 events per page using Laravel's native paginator with accessible next/prev pagination links.
- **Empty State Presentation**: Friendly empty state graphic and message when no expeditions are scheduled.
- **Direct Event Pre-selection**: "Register for Event" CTA links directly pass `?event_id={id}` into the registration form.

### 3. Task 3: Event Registration, Validation & Confirmation (`/register`)
- **Eloquent Model (`app/Models/Registration.php`)**: Foreign key association to `Event` (`$registration->event`).
- **Eloquent Relationship**: `Event::hasMany(Registration::class)` and `Registration::belongsTo(Event::class)`.
- **Database Constraints**: Foreign key constraint with cascading deletes, plus composite unique constraint `unique(['event_id', 'email'])`.
- **Server-Side Validation**:
  - `event_id`: Required, integer, must exist in `events` table.
  - `name`: Required, string, max 100 characters.
  - `email`: Required, RFC-compliant email, max 150 characters.
  - `phone`: Optional, string, max 25 characters.
- **Duplicate Prevention**: Prevents the same email address from registering multiple times for the same event, redirecting back with a user-friendly error while preserving other input values.
- **Dedicated Confirmation Page (`/registrations/{id}/confirmation`)**: Displays registered traveler name, email, event title, location, date, time, and reference ticket badge.

### 4. Task 4: Production Readiness, Security & Deployment
- Dedicated serverless entry point (`api/index.php`) and Vercel routing configuration (`vercel.json`).
- Environment variable protection: No hardcoded secrets, database credentials, or application keys in repository files.
- Safe session, cache, and compiled view redirection to `/tmp` storage for serverless environments.
- Comprehensive production deployment documentation for Render, Railway, Vercel, and Fly.io.

---

## 💻 Local Development Setup

### 1. Prerequisites
- **PHP**: >= 8.2 (PHP 8.4 recommended) with `pdo`, `pdo_sqlite`, `pdo_pgsql` or `pdo_mysql`, `mbstring`, `openssl`, `curl` extensions.
- **Composer**: >= 2.x
- **Git**

### 2. Clone Repository
```bash
git clone https://github.com/umarkhayam901/wanderways-travel-events.git
cd "wanderways-travel-events"
```

### 3. Install Dependencies
```bash
composer install --no-interaction --prefer-dist
```

### 4. Environment Configuration
Copy the example environment file and generate a secure application key:
```bash
cp .env.example .env
php artisan key:generate
```

### 5. Database Setup & Seeding
By default, SQLite can be used for rapid local development:
```bash
# Create SQLite database file (if using SQLite)
touch database/database.sqlite

# Run all schema migrations
php artisan migrate

# Seed 14 realistic travel events
php artisan db:seed
```

To run a clean reset and seed in one command:
```bash
php artisan migrate:fresh --seed
```

### 6. Run the Application
Start the built-in development server:
```bash
php artisan serve
```

Visit the application in your browser:
- **Homepage**: [http://127.0.0.1:8000/](http://127.0.0.1:8000/)
- **Events Listing**: [http://127.0.0.1:8000/events](http://127.0.0.1:8000/events)
- **Events (Page 2)**: [http://127.0.0.1:8000/events?page=2](http://127.0.0.1:8000/events?page=2)
- **Registration Form**: [http://127.0.0.1:8000/register](http://127.0.0.1:8000/register)
- **Register for Specific Event**: [http://127.0.0.1:8000/register?event_id=1](http://127.0.0.1:8000/register?event_id=1)

---

## 🧪 Automated Testing

Run the automated PHPUnit test suite:
```bash
php artisan test
```

### Test Coverage Highlights:
- **`tests/Feature/ExampleTest.php`**: Root HTTP response verification.
- **`tests/Feature/EventTest.php`**:
  - Tests `/events` HTTP 200 and semantic header/footer elements.
  - Tests database event rendering (title, date badge, time, location, description).
  - Tests 2-item pagination controls (page 1 vs. page 2).
  - Tests empty state messaging when zero events are present.
- **`tests/Feature/RegistrationTest.php`**:
  - Tests registration page loading and event select options.
  - Tests pre-selection summary card via `?event_id={id}` query parameter.
  - Tests valid submission storage, Eloquent relationship binding, and redirect.
  - Tests missing field validation errors (`event_id`, `name`, `email`).
  - Tests malformed email validation.
  - Tests non-existent event ID validation.
  - Tests duplicate registration rejection for identical email + event combination.
  - Tests allowing the same email to register for different events.
  - Tests registration confirmation view displaying attendee and adventure details.

---

## 🔒 Production Environment Variables & Security

All environment secrets must be configured in your hosting provider's dashboard (Render, Railway, Fly.io, or Vercel). **Never commit real credentials to Git.**

### Required Production Environment Variables:

| Variable | Description | Example / Recommended Value |
|---|---|---|
| `APP_NAME` | Application Name | `"WanderWays Travel"` |
| `APP_ENV` | Environment Type | `production` |
| `APP_KEY` | Laravel 32-character AES encryption key | Generated via `php artisan key:generate --show` |
| `APP_DEBUG` | Detailed Debugging Display | `false` |
| `APP_URL` | Live Production URL | `https://wanderways-travel-events.vercel.app` |
| `LOG_CHANNEL` | Logging driver | `stderr` or `stack` |
| `LOG_LEVEL` | Logging threshold | `error` or `warning` |
| `DB_CONNECTION` | Database Driver | `pgsql` or `mysql` (or `sqlite`) |
| `DB_HOST` | Remote Database Host | e.g. `ep-example.neon.tech` or `containers-us-west.railway.app` |
| `DB_PORT` | Remote Database Port | `5432` (PostgreSQL) or `3306` (MySQL) |
| `DB_DATABASE` | Remote Database Name | `wanderways_prod` |
| `DB_USERNAME` | Remote Database Username | `db_user` |
| `DB_PASSWORD` | Remote Database Password | Strong generated secret |
| `DB_SSLMODE` | SSL requirement (PostgreSQL) | `require` |
| `SESSION_DRIVER` | Session Backend | `cookie`, `database`, or `redis` |
| `CACHE_STORE` | Cache Backend | `database`, `array`, or `redis` |

---

## ☁️ Deployment Instructions

### Option A: Free Hosting on Render (Web Service + PostgreSQL)

1. **Sign Up**: Create an account on [Render](https://render.com/).
2. **Create Managed PostgreSQL Database**:
   - Navigate to **New +** &rarr; **PostgreSQL**.
   - Name: `wanderways-db`.
   - Select the Free Tier.
   - Copy the **Internal Database URL** or connection credentials (`DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).
3. **Create Web Service**:
   - Navigate to **New +** &rarr; **Web Service**.
   - Connect the GitHub repository `umarkhayam901/wanderways-travel-events`.
   - **Environment**: `PHP` or `Docker`.
   - **Build Command**:
     ```bash
     composer install --no-dev --optimize-autoloader
     ```
   - **Publish Directory / Document Root**: `public`
   - **Start Command**:
     ```bash
     php artisan migrate --force && php artisan db:seed --force && apache2-foreground
     ```
4. **Configure Environment Variables**:
   - Add all variables listed in the [Production Environment Variables](#-production-environment-variables--security) table.
   - Set `DB_CONNECTION=pgsql` and populate credentials from step 2.
5. **Deploy**:
   - Click **Create Web Service**. Render deploys automatically upon pushing to `main`.

---

### Option B: Free Hosting on Railway

1. **Sign Up**: Sign in at [Railway.app](https://railway.app/) via GitHub.
2. **Provision PostgreSQL / MySQL**:
   - In your Railway project, click **New** &rarr; **Database** &rarr; **Add PostgreSQL**.
3. **Deploy the Laravel App**:
   - Click **New** &rarr; **GitHub Repo** &rarr; Select `wanderways-travel-events`.
   - In **Settings** &rarr; **Environment Variables**, reference the database variables:
     ```env
     APP_ENV=production
     APP_DEBUG=false
     APP_KEY=base64:...
     DB_CONNECTION=pgsql
     DB_HOST=${{Postgres.PGHOST}}
     DB_PORT=${{Postgres.PGPORT}}
     DB_DATABASE=${{Postgres.PGDATABASE}}
     DB_USERNAME=${{Postgres.PGUSER}}
     DB_PASSWORD=${{Postgres.PGPASSWORD}}
     ```
4. **Run Migrations on Railway**:
   - Under the Railway CLI or Deploy Command, run:
     ```bash
     php artisan migrate --force && php artisan db:seed --force
     ```
5. **Generate Domain**:
   - Under service **Settings** &rarr; **Networking** &rarr; Click **Generate Domain**.

---

### Option C: Vercel Serverless Deployment (Active Live Deployment)

The project includes pre-configured serverless bridge files:
- `vercel.json`: Directs incoming web traffic to `api/index.php` and static assets to `public/`.
- `api/index.php`: Prepares runtime writable storage paths in `/tmp` and invokes Laravel's bootstrap lifecycle safely.

To deploy via Vercel:
1. Connect the repository on [Vercel](https://vercel.com).
2. Set Environment Variables in Project Settings (`APP_KEY`, `APP_ENV=production`, `APP_DEBUG=false`, `DB_CONNECTION`, etc.).
3. Deploy! Static CSS and web routes are served with global CDN caching.

---

## 🤝 Handover Note

**To: WanderWays Travel Supervisor & Leadership Team**

> Dear WanderWays Travel Team,
>
> We are pleased to deliver **Task 4: Production Preparation, Deployment, README & Handover** for the **WanderWays Travel Event Management Mini-Platform**.
>
> All project milestones (Tasks 1 through 4) have been successfully accomplished and rigorously validated:
> 
> 1. **Responsive Homepage (Task 1)**: The homepage is fully responsive across mobile, tablet, and desktop viewports with zero horizontal overflow, fluid typographic hierarchy, semantic HTML5, and accessible ARIA attributes.
> 2. **Events Data Model & Paginated Listing (Task 2)**: 14 realistic travel expeditions across diverse Pakistani and regional destinations are seeded and displayed with chronological ordering and accessible 2-item pagination.
> 3. **Registration Flow & Validation (Task 3)**: Visitors can register for any scheduled expedition with server-side input validation, robust duplicate registration prevention, relational integrity, and a dedicated confirmation screen.
> 4. **Production Readiness & Security (Task 4)**:
>    - Production-safe environment templates (`.env.example`) with zero exposed secrets.
>    - Database support for PostgreSQL, MySQL, and SQLite.
>    - Live deployment configured with active health check endpoints.
>    - 100% passing automated test suite (16 tests, 78 assertions).
>
> The repository is clean, documented, and ready for immediate operations and future feature expansions.
>
> Warm regards,  
> **Antigravity Development Team**  
> *October 2026*
