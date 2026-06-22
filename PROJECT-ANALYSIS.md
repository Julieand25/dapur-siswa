# Project Analysis — What's Still Hardcoded / Needs Work

Generated 2026-06-22.

## Still Hardcoded Views

| View | Route | Data |
|---|---|---|
| `resources/views/feedback-list.blade.php` | `GET /laporan/maklumbalas` | 7 rows of fake feedback (names, matrik, dates, ratings, comments) |
| `resources/views/feedback-detail.blade.php` | `GET /laporan/maklumbalas/{id}` | Static profile + fake comments — ignores the `{id}` param |
| `resources/views/record-list.blade.php` | `GET /laporan/rekod` | 6 rows of fake booking records (name, matrik, email, loc, dapur) |
| `resources/views/record-detail.blade.php` | `GET /laporan/rekod/{id}` | Full fake booking detail with hardcoded peralatan + bahan tables |
| `resources/views/welcome.blade.php` | `GET /` | Static landing page — probably fine as-is |

## Routes Still Using Closures (No Controller)

| Route | Action |
|---|---|
| `GET /` | `welcome` — fine as-is, landing page |
| `GET /laporan/maklumbalas` | Needs `FeedbackController` + model |
| `GET /laporan/maklumbalas/{id}` | Needs `FeedbackController@show` + model |
| `GET /laporan/rekod` | Could reuse `AllBookingController` (record = booking) |
| `GET /laporan/rekod/{id}` | Could reuse booking detail logic |

## Models Missing Factory Files

| Model | Why it matters |
|---|---|
| `Booking` | Can't use `Booking::factory()->create()` in tests |
| `Dapur` | Can't use `Dapur::factory()->create()` in tests |
| `Peralatan` | Can't use `Peralatan::factory()->create()` in tests |
| `Bahan` | Can't use `Bahan::factory()->create()` in tests |

## Controllers Without Feature Tests

**App controllers (8 missing):**
`AllBookingController`, `BarangController`, `DapurController`, `DashboardController`, `KalendarController`, `PendingBookingController`, `TetapanController`, `UserListController`

**Auth controllers (5 missing):**
`EmailVerificationNotificationController`, `PasswordResetLinkController`, `VerifyEmailController`, `VerifyOtpController`, `VerifyPasswordResetOtpController`

Only `ProfileController` (routes commented out) and the Breeze auth controllers have tests.

## Other Issues / Improvements

### Technical debt

- **ProfileController still imported** in `web.php` but routes are commented out (lines 61-65). Can be removed.
- **No request validation classes** — all validation is inline in controllers. Move to Form Requests for cleaner code.
- **No notification for rejected bookings** — admin rejects a booking but the mobile user has no in-app notification (depends on mobile app capabilities).
- **No 404 handling for missing `auth.users`** — if `auth.users` query returns empty, the app shows `—` gracefully (already handled).

### Potential new features

- **Dashboard stat cards** — only show today count + pending. Could add: approved today, total this month, most popular dapur.
- **Calendar** — could show approved bookings in the slot modal (currently shows all, which is fine). Could highlight today automatically on load.
- **Export CSV** — useful for laporan/rekod pages.
- **Pagination on all-booking** — already done (8/page).
- **Breadcrumbs** — current pages only use sidebar active state. Could add breadcrumb navigation.

### Recommended priority

1. **High**: Create feedback model + controller + dynamic views (maklumbalas pages are the last truly hardcoded CRUD)
2. **High**: Wire record/rekod pages to booking data (reuse Booking model + AllBookingController pattern)
3. **Medium**: Add model factories for Dapur, Peralatan, Bahan, Booking to enable testing
4. **Medium**: Add feature tests for the 8 app controllers
5. **Low**: Clean up commented ProfileController code in routes/web.php
6. **Low**: Move validation to Form Request classes
