# AGENTS.md — Dapur Siswa Madani UPSI

## Project Overview
Laravel 13.x booking system for a university student kitchen ("Dapur Siswa Madani"), targeting UPSI (Universiti Pendidikan Sultan Idris). All UI text is in **Bahasa Malaysia**.

## Stack & Versions
- PHP ^8.3, Laravel ^13.8
- SQLite (default via `.env`; `database/database.sqlite` already committed)
- Tailwind CSS v3 + Alpine.js via Vite
- Laravel Breeze (auth scaffolding, Blade stack)
- Pest v4 for testing (not raw PHPUnit)

## Commands

| Action | Command |
|---|---|
| Install project | `composer run setup` (runs composer + npm install, key:gen, migrate, build) |
| Run dev server | `composer run dev` (starts serve + queue + pail + vite concurrently) |
| Build assets | `npm run build` |
| Watch assets | `npm run dev` |
| Run all tests | `composer run test` or `php artisan test` |
| Lint PHP | `./vendor/bin/pint` |
| List routes | `php artisan route:list` |

## Database
- Default connection is SQLite (`database/database.sqlite`). No external DB service needed.
- Session, cache, and queue all use the `database` driver (SQLite tables).
- Tests use SQLite `:memory:` (set in `phpunit.xml`), with `RefreshDatabase` trait on all Feature tests via `tests/Pest.php`.

## Architecture & Layout
- **Two layout systems coexist:**
  - `layouts/app.blade.php` — default Breeze layout (Tailwind + navbar), used by auth pages and `/`.
  - `components/admin-layout.blade.php` — custom admin shell with `<x-sidebar>` and `<x-topbar>`. Used by dashboard and all `/dapur/*`, `/pengguna`, `/laporan/*`, `/kalendar`, `/tetapan` pages.
- `<x-sidebar>` defines all navigation items inline in `resources/views/components/sidebar.blade.php:4-17`. The `active` prop maps to the `key` fields there.
- Auth middleware is **currently commented out** on dashboard/auth routes — the app is in UI-prototyping/wireframing phase.
- Routes return Blade views directly with hardcoded/fake data. No real controllers or models exist beyond Breeze's `User` model and auth controllers.
- User model is standard Breeze `App\Models\User` (id, name, email, password). No custom fields yet.

## Page ↔ Route ↔ View Map

| Page | Route name | View file |
|---|---|---|
| Dashboard | `dashboard` | `dashboard.blade.php` |
| Pending bookings | `pending-booking` | `pending-booking.blade.php` |
| All bookings | `all-booking` | `all-booking.blade.php` |
| Dapur list | `dapur.index` | `dapur-list.blade.php` |
| Create dapur | `dapur.create` | `create-dapur.blade.php` |
| Edit dapur | `dapur.edit` | `edit-dapur.blade.php` |
| Manage barang | `dapur.barang` | `manage-barang.blade.php` |
| User list | `pengguna.index` | `user-list.blade.php` |
| Calendar | `kalendar.index` | `kalendar.blade.php` |
| Feedback list | `laporan.maklumbalas` | `feedback-list.blade.php` |
| Feedback detail | `laporan.maklumbalas.show` | `feedback-detail.blade.php` |
| Record list | `laporan.rekod` | `record-list.blade.php` |
| Record detail | `laporan.rekod.show` | `record-detail.blade.php` |
| Settings | `tetapan.index` | `settings.blade.php` |

## Conventions
- Indentation: 4 spaces for PHP/JS/CSS, 2 spaces for YAML (`.editorconfig`).
- New views should extend `<x-admin-layout>` (unless they are public/auth pages).
- When adding nav items, update both `sidebar.blade.php` (the `$navItems` array) AND `web.php` (the route).
- Use inline `<style>` blocks with `@push('styles')` / `@stack('styles')` for page-specific CSS. The admin layout supports this pattern.
- Use Pest syntax for tests (e.g. `it('describes behavior', function () { ... })`), not PHPUnit classes.
- Composer command `@no_additional_args` prevents artisan from absorbing extra CLI args passed to composer scripts.

## Gotchas
- `.npmrc` sets `ignore-scripts=true` — composer's setup script passes `--ignore-scripts` to `npm install` to match.
- `npm install` alone will NOT build assets; you must run `npm run build` afterward.
- No CI/CD pipeline configured. There are no GitHub Actions workflows.
- Laravel Boost is NOT installed (the README suggests it generically; don't install unless asked).
