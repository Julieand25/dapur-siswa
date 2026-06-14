<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Masuk – Dapur Siswa MADANI UPSI</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            height: 100vh;
            overflow: hidden;
            display: flex;
            flex-direction: row;
            background: #ffffff;
        }

        /* ── Left Panel ── */
        .left-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 48px 48px;
            gap: 24px;
            overflow-y: auto;
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
            width: 200px;
            max-width: 100%;
            object-fit: contain;
        }

        .tagline p {
            font-size: 14.5px;
            font-weight: 700;
            color: #1a3a8f;
            line-height: 1.5;
        }

        .madani-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: 4px;
            font-size: 13px;
            font-weight: 700;
            color: #c00;
            letter-spacing: 0.04em;
            line-height: 1.3;
        }

        /* ── Form ── */
        .form-card {
            width: 100%;
            max-width: 340px;
            display: flex;
            flex-direction: column;
            gap: 16px;
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
        .form-group input[type="password"] {
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

        /* Remember me row */
        .remember-row {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .remember-row input[type="checkbox"] {
            width: 15px;
            height: 15px;
            accent-color: #1a56db;
            cursor: pointer;
        }

        .remember-row label {
            font-size: 13px;
            color: #4b5563;
            cursor: pointer;
        }

        /* Forgot password */
        .forgot-link {
            font-size: 12.5px;
            color: #4b5563;
            text-decoration: underline;
            text-align: right;
            display: block;
            margin-top: -8px;
        }

        .forgot-link:hover { color: #1a56db; }

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

        .btn-primary   { background: #1a56db; color: #fff; }
        .btn-secondary { background: #fff; color: #1a3a8f; border: 2px solid #1a3a8f; margin-top: 4px; }

        /* Session status */
        .session-status {
            font-size: 13px;
            color: #15803d;
            background: #dcfce7;
            border-radius: 6px;
            padding: 8px 12px;
        }

        /* ── Right Panel ── */
        .right-panel {
            width: 25%;
            flex-shrink: 0;
            height: 100vh;
            overflow: hidden;
        }

        .right-panel img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            body { flex-direction: column; overflow: auto; height: auto; min-height: 100vh; }
            .left-panel { width: 100%; padding: 36px 24px; }
            .right-panel { width: 100%; height: 220px; flex-shrink: 0; }
        }
    </style>
</head>
<body>

    {{-- ── Left: Login Panel ── --}}
    <div class="left-panel">

        {{-- Logo & Tagline --}}
        <div class="logo-wrap">
            <img src="{{ asset('images/dapur-siswa-logo.png') }}" alt="Dapur Siswa MADANI UPSI">
            <div class="tagline">
                <p>Sistem Tempahan Dapur Siswa<br>MADANI UPSI</p>
                <div class="madani-badge">🇲🇾 MALAYSIA MADANI</div>
            </div>
        </div>

        {{-- Session Status --}}
        @if (session('status'))
            <div class="session-status">{{ session('status') }}</div>
        @endif

        {{-- Login Form --}}
        <form method="POST" action="{{ route('login') }}" class="form-card">
            @csrf

            {{-- Email --}}
            <div class="form-group">
                <label for="email">{{ __('Email') }}</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="nama@email.com"
                >
                @error('email')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            {{-- Password --}}
            <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••"
                >
                @error('password')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            {{-- Remember Me --}}
            <div class="remember-row">
                <input id="remember_me" type="checkbox" name="remember">
                <label for="remember_me">{{ __('Remember me') }}</label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link" style="margin-left:auto;">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            {{-- Log Masuk --}}
            <button type="submit" class="btn btn-primary">Log Masuk</button>

            {{-- Daftar Akaun --}}
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-secondary">Daftar Akaun</a>
            @endif

        </form>

    </div>

    {{-- ── Right: Kitchen Photo ── --}}
    <div class="right-panel">
        <img src="{{ asset('images/dapur.png') }}" alt="Dapur Siswa Kitchen">
    </div>

</body>
</html>