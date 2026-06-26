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
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.55)),
                        url('{{ asset('images/dapur2.jpg') }}');
            background-size: cover;
            background-position: center;
        }

        .content-card {
            background: rgba(255,255,255,0.95);
            border-radius: 16px;
            padding: 48px 40px;
            max-width: 420px;
            width: 90%;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }

        .content-card img {
            width: 200px;
            max-width: 100%;
            object-fit: contain;
            margin-bottom: 32px;
        }

        .form-card {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 16px;
            text-align: left;
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

        .error-msg {
            font-size: 12px;
            color: #dc2626;
            margin-top: 2px;
        }

        .forgot-link {
            font-size: 12.5px;
            color: #4b5563;
            text-decoration: underline;
            text-align: right;
            display: block;
        }

        .forgot-link:hover { color: #1a56db; }

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

        .session-status {
            font-size: 13px;
            color: #15803d;
            background: #dcfce7;
            border-radius: 6px;
            padding: 8px 12px;
            margin-bottom: 8px;
            text-align: center;
        }

        @media (max-width: 768px) {
            body { padding: 20px; }
            .content-card { padding: 32px 24px; }
        }
    </style>
</head>
<body>

    <div class="content-card">

        <img src="{{ asset('images/dapur-siswa-logo.png') }}" alt="Dapur Siswa MADANI UPSI">

        @if (session('status'))
            <div class="session-status">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="form-card">
            @csrf

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
                    placeholder="email"
                >
                @error('email')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

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

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="forgot-link">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <button type="submit" class="btn btn-primary">Log Masuk</button>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-secondary">Daftar Akaun</a>
            @endif

        </form>

    </div>

</body>
</html>