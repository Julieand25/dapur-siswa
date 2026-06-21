<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tetapkan Semula Kata Laluan – Dapur Siswa MADANI UPSI</title>
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
            max-width: 440px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 24px;
        }

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

        .card {
            width: 100%;
            background: #fff;
            border-radius: 12px;
            padding: 32px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08), 0 4px 12px rgba(0,0,0,0.04);
        }

        .card h2 {
            font-size: 18px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 20px;
        }

        .form-card {
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

        .form-group input {
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

        .back-link {
            font-size: 13px;
            color: #4b5563;
            text-align: center;
        }

        .back-link a {
            color: #1a56db;
            font-weight: 600;
            text-decoration: none;
        }

        .back-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .card { padding: 24px 20px; }
        }
    </style>
</head>
<body>

    <div class="container">

        <div class="logo-wrap">
            <img src="{{ asset('images/dapur-siswa-logo.png') }}" alt="Dapur Siswa MADANI UPSI">
        </div>

        <div class="card">
            <h2>Tetapkan Semula Kata Laluan</h2>

            <form method="POST" action="{{ route('password.store') }}" class="form-card">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <input type="hidden" name="email" value="{{ old('email', $request->email) }}">

                <div class="form-group">
                    <label for="password">Kata Laluan Baharu</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        placeholder="Masukkan kata laluan baharu"
                    >
                    @error('password')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Sahkan Kata Laluan</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="Masukkan semula kata laluan"
                    >
                    @error('password_confirmation')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Tetapkan Semula</button>
            </form>
        </div>

        <div class="back-link">
            <a href="{{ route('login') }}">Kembali ke Log Masuk</a>
        </div>

    </div>

</body>
</html>
