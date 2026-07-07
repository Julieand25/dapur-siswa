# AGENTS.md — Dapur Siswa Madani UPSI

## Project Overview
Laravel 13.x booking system for a university student kitchen ("Dapur Siswa Madani"), targeting UPSI (Universiti Pendidikan Sultan Idris). All UI text is in **Bahasa Malaysia**.

## Stack & Versions
- PHP ^8.3, Laravel ^13.8
- **Supabase Auth + PostgreSQL** (live `.env`); SQLite via `.env.example` default
- Tailwind CSS v3 + Alpine.js via Vite
- Laravel Breeze (Blade stack) **with OTP-based email verification (not link-based)**
- Pest v4 for testing

## Commands

| Action | Command |
|---|---|
| Install project | `composer run setup` |
| Run dev server | `composer run dev` (serve + queue + pail + vite concurrently) |
| Build assets | `npm run build` |
| Watch assets | `npm run dev` |
| Run all tests | `composer run test` or `php artisan test` |
| Lint PHP | `./vendor/bin/pint` |
| List routes | `php artisan route:list` |

## Database
- `.env.example` defaults to SQLite; `.env` is configured for PostgreSQL (Supabase). `database/database.sqlite` is a stale artifact.
- Session, cache, and queue all use the `database` driver (PostgreSQL tables).
- Tests use SQLite `:memory:` (set via `<env>` in `phpunit.xml`). `RefreshDatabase` trait is applied to all Feature tests via `tests/Pest.php`.

## Supabase Auth Integration (Critical)
- **User authentication is handled by Supabase Auth, NOT Laravel's `users` table.**
- **User lookups in controllers use `DB::table('auth.users')`** (the Supabase `auth` schema in PostgreSQL). Using `User::find($id)` will fail for non-admin users stored in Supabase.
- The local `staff` table (renamed from `users`) exists alongside `auth.staff`. The `User` Eloquent model (`$table = 'staff'`) represents the local staff table, which stores admin users with extended fields (`phone`, `position`, `avatar_url`).
- Additional user profiles are stored in the `profiles` table (public schema, joined via `profiles.id::uuid`).
- Avatar uploads use Supabase Storage (`config('services.supabase')`).

## OTP Email Verification
- Breeze's default email verification flow is replaced with OTP codes sent via `App\Notifications\EmailVerificationOtp` and `App\Notifications\PasswordResetOtp`.
- Custom controllers in `app/Http/Controllers/Auth/`: `VerifyOtpController`, `VerifyPasswordResetOtpController`.

## Architecture & Layout
- **Two layout systems:**
  - `layouts/app.blade.php` — default Breeze layout, used by auth pages and `/`.
  - `components/admin-layout.blade.php` — custom admin shell with `<x-sidebar>` and `<x-topbar>`. Used by all authenticated pages.
- `<x-sidebar>` defines navigation items inline at `sidebar.blade.php:4-17`. The `active` prop maps to `key` fields.
- **The app now has real controllers and Eloquent models** backed by database tables. See table below for the route-to-controller mapping.
- Auth middleware on all admin routes (`auth` + `verified`). Breeze profile routes (`profile.edit`, etc.) are **commented out** — profile management is handled via `/tetapan`.

## Models & Key Tables

| Model | Table | Notes |
|---|---|---|
| `App\Models\User` | `staff` | Admin users only; `$incrementing = true`, has `phone`, `position`, `avatar_url` |
| `App\Models\Dapur` | `dapur` | Has `peralatans()` and `bahans()` HasMany relations; `scopeFilter()` for search/filter |
| `App\Models\Booking` | `bookings` | UUID primary key, `$incrementing = false`, `$timestamps = false` |
| `App\Models\Peralatan` | `peralatans` | Belongs to Dapur; status: `Tersedia`, `Rosak`, `Diselenggara` |
| `App\Models\Bahan` | `bahan` | Belongs to Dapur; has `low_stock_threshold` column |
| `App\Models\Announcement` | `announcements` | UUID primary key, `$incrementing = false`; uses `AnnouncementHelper` for content rendering |

## Page ↔ Route ↔ Controller ↔ View Map

| Page | Route | Controller Method | View |
|---|---|---|---|
| Dashboard | `dashboard` | `DashboardController@index` | `dashboard.blade.php` |
| Approve booking | `bookings.status` (PATCH) | `DashboardController@updateStatus` | — (redirect back) |
| Pending bookings | `pending-booking` | `PendingBookingController@index` | `pending-booking.blade.php` |
| All bookings | `all-booking` | `AllBookingController@index` | `all-booking.blade.php` |
| Dapur list | `dapur.index` | `DapurController@index` | `dapur-list.blade.php` |
| Create dapur | `dapur.create` | `DapurController@create` | `create-dapur.blade.php` |
| Edit dapur | `dapur.edit` | `DapurController@edit` | `edit-dapur.blade.php` |
| Manage barang | `dapur.barang` | `BarangController@index` | `manage-barang.blade.php` |
| Announcements (index) | `pemberitahuan.index` | `AnnouncementController@index` | `pemberitahuan-index.blade.php` |
| Announcements (create) | `pemberitahuan.create` | `AnnouncementController@create` | `pemberitahuan-create.blade.php` |
| Announcements (edit) | `pemberitahuan.edit` | `AnnouncementController@edit` | `pemberitahuan-edit.blade.php` |
| User list | `pengguna.index` | `UserListController@index` | `user-list.blade.php` |
| Calendar | `kalendar.index` | `KalendarController@index` | `kalendar.blade.php` |
| Feedback list | `laporan.maklumbalas` | `FeedbackController@index` | `feedback-list.blade.php` |
| Feedback detail | `laporan.maklumbalas.show` | `FeedbackController@show` | `feedback-detail.blade.php` |
| Record list | `laporan.rekod` | `RecordController@index` | `record-list.blade.php` |
| Record detail | `laporan.rekod.show` | `RecordController@show` | `record-detail.blade.php` |
| Settings | `tetapan.index` | `TetapanController@index` | `settings.blade.php` |
| Update profile | `tetapan.profile.update` (PATCH) | `TetapanController@updateProfile` | — (redirect back) |

## Conventions
- Indentation: 4 spaces for PHP/JS/CSS, 2 spaces for YAML (`.editorconfig`).
- New views should extend `<x-admin-layout>` (unless public/auth pages).
- When adding nav items, update both `sidebar.blade.php` (the `$navItems` array) AND `web.php` (the route).
- Use inline `<style>` blocks with `@push('styles')` / `@stack('styles')` for page-specific CSS.
- Use Pest syntax for tests, not PHPUnit classes.
- Composer command `@no_additional_args` prevents artisan from absorbing extra CLI args.

## Gotchas
- `.npmrc` sets `ignore-scripts=true` — `npm install` alone won't build assets; you must run `npm run build` afterward.
- `Announcement` model uses route model binding as `{pemberitahuan}` (Malay parameter name), not `{announcement}`.
- No CI/CD pipeline configured. `Dockerfile` exists for production deployment (nginx + php-fpm on port 8080).
- Laravel Boost is NOT installed (README suggests it generically; don't install unless asked).
