<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang – Dapur Siswa MADANI UPSI</title>
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

        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 14px;
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

        .btn-primary   { background: #1a56db; color: #fff; }
        .btn-secondary { background: #fff; color: #1a3a8f; border: 2px solid #1a3a8f; }

        @media (max-width: 768px) {
            body { padding: 20px; }
            .content-card { padding: 32px 24px; }
        }
    </style>
</head>
<body>

    <div class="content-card">

        <img src="{{ asset('images/dapur-siswa-logo.png') }}" alt="Dapur Siswa MADANI UPSI">

        <div class="btn-group">
            <a href="{{ route('login') }}" class="btn btn-primary">Log Masuk</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-secondary">Daftar Akaun</a>
            @endif
        </div>

    </div>

</body>
</html>