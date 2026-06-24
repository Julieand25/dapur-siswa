<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akaun – Dapur Siswa MADANI UPSI</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f9fafb;
            padding: 24px;
        }

        .container {
            width: 100%;
            max-width: 500px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 24px;
        }

        /* Logo & Tagline */
        .logo-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            text-align: center;
        }

        .logo-wrap img {
            width: 180px;
            max-width: 100%;
            object-fit: contain;
        }

        /* ── Card ── */
        .card {
            width: 100%;
            background: #fff;
            border-radius: 12px;
            padding: 32px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08), 0 4px 12px rgba(0,0,0,0.04);
        }

        /* ── Form ── */
        .form-card {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .form-row {
            display: flex;
            gap: 12px;
        }

        .form-row .form-group {
            flex: 1;
            min-width: 0;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .form-group label {
            font-size: 13px;
            font-weight: 600;
            color: #374151;
        }

        .form-group input[type="email"],
        .form-group input[type="password"],
        .form-group input[type="text"],
        .form-group input[type="tel"] {
            width: 100%;
            padding: 10px 12px;
            border: 1.5px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
            color: #111827;
            background: #fff;
            transition: border-color 0.15s;
            outline: none;
        }

        .form-group input:focus {
            border-color: #1a56db;
            box-shadow: 0 0 0 3px rgba(26,86,219,0.12);
        }

        /* Error text */
        .error-msg {
            font-size: 12px;
            color: #dc2626;
            margin-top: 2px;
        }

        /* Checkbox row */
        .checkbox-row {
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }

        .checkbox-row input[type="checkbox"] {
            width: 15px;
            height: 15px;
            accent-color: #1a56db;
            cursor: pointer;
            margin-top: 2px;
            flex-shrink: 0;
        }

        .checkbox-row label {
            font-size: 12.5px;
            color: #4b5563;
            cursor: pointer;
            line-height: 1.4;
        }

        /* Buttons */
        .btn {
            display: block;
            width: 100%;
            padding: 13px 24px;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 600;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
            letter-spacing: 0.02em;
            transition: filter 0.15s, transform 0.1s;
            border: none;
        }

        .btn:hover  { filter: brightness(1.08); transform: translateY(-1px); }
        .btn:active { transform: translateY(0); }

        .btn-primary { background: #1a56db; color: #fff; }

        /* Session status */
        .session-status {
            font-size: 13px;
            color: #15803d;
            background: #dcfce7;
            border-radius: 6px;
            padding: 8px 12px;
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #9ca3af;
            font-size: 13px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #d1d5db;
        }

        /* Login link */
        .login-link {
            font-size: 13px;
            color: #4b5563;
            text-align: center;
        }

        .login-link a {
            color: #1a56db;
            font-weight: 600;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        /* ── Responsive ── */
        @media (max-width: 480px) {
            .form-row {
                flex-direction: column;
            }
            .card {
                padding: 24px 20px;
            }
        }
    </style>
</head>
<body>

    <div class="container">

        {{-- Logo & Tagline --}}
        <div class="logo-wrap">
            <img src="{{ asset('images/dapur-siswa-logo.png') }}" alt="Dapur Siswa MADANI UPSI">

        </div>

        {{-- Session Status --}}
        @if (session('status'))
            <div class="session-status">{{ session('status') }}</div>
        @endif

        {{-- Card --}}
        <div class="card">
            <form method="POST" action="{{ route('register') }}" class="form-card">
                @csrf

                {{-- Row: Nama Penuh | Email Staff --}}
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Nama Penuh</label>
                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autofocus
                            autocomplete="name"
                        >
                        @error('name')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email Staff</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="username"
                            placeholder="nama@upsi.edu.my"
                        >
                        @error('email')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Row: No. Telefon | Jawatan --}}
                <div class="form-row">
                    <div class="form-group">
                        <label for="phone">No. Telefon</label>
                        <input
                            id="phone"
                            type="tel"
                            name="phone"
                            value="{{ old('phone') }}"
                            required
                            autocomplete="tel"
                        >
                        @error('phone')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="position">Jawatan</label>
                        <input
                            id="position"
                            type="text"
                            name="position"
                            value="{{ old('position') }}"
                            required
                        >
                        @error('position')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Kata Laluan --}}
                <div class="form-group">
                    <label for="password">Kata Laluan</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                    >
                    @error('password')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Sahkan Kata Laluan --}}
                <div class="form-group">
                    <label for="password_confirmation">Sahkan Kata Laluan</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                    >
                    @error('password_confirmation')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Terms Checkbox --}}
                <div class="checkbox-row">
                    <input id="terms" type="checkbox" name="terms" required>
                    <label for="terms">Saya bersetuju dengan Terma dan Syarat dan Polisi Privasi.</label>
                    @error('terms')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Daftar Akaun Button --}}
                <button type="submit" class="btn btn-primary">Daftar Akaun</button>

                {{-- Divider --}}
                <div class="divider">atau</div>

                {{-- Login Link --}}
                <div class="login-link">
                    sudah mempunyai akaun?
                    <a href="{{ route('login') }}">Log masuk di sini</a>
                </div>

            </form>
        </div>

    </div>

</body>
</html>
