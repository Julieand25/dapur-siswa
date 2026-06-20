<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sahkan Emel – Dapur Siswa MADANI UPSI</title>
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
            margin-bottom: 12px;
        }

        .card p {
            font-size: 13.5px;
            color: #4b5563;
            line-height: 1.6;
        }

        .card .email-highlight {
            font-weight: 600;
            color: #111827;
        }

        .status-msg {
            font-size: 13px;
            color: #15803d;
            background: #dcfce7;
            border-radius: 6px;
            padding: 10px 14px;
            line-height: 1.5;
            margin-top: 16px;
        }

        .actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 20px;
            gap: 12px;
        }

        .btn {
            display: inline-block;
            padding: 12px 22px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            text-align: center;
            cursor: pointer;
            letter-spacing: 0.02em;
            transition: filter 0.15s, transform 0.1s;
            border: none;
        }

        .btn:hover  { filter: brightness(1.08); transform: translateY(-1px); }
        .btn:active { transform: translateY(0); }

        .btn-primary { background: #1a56db; color: #fff; }

        .btn-logout {
            background: none;
            color: #6b7280;
            font-size: 13px;
            font-weight: 500;
            text-decoration: underline;
            cursor: pointer;
            border: none;
            padding: 8px 4px;
        }

        .btn-logout:hover { color: #374151; }

        @media (max-width: 480px) {
            .card { padding: 24px 20px; }
            .actions { flex-direction: column; align-items: stretch; }
            .actions .btn { width: 100%; }
        }
    </style>
</head>
<body>

    <div class="container">

        <div class="logo-wrap">
            <img src="{{ asset('images/dapur-siswa-logo.png') }}" alt="Dapur Siswa MADANI UPSI">
        </div>

        <div class="card">
            <h2>Sahkan Alamat Emel Anda</h2>
            <p>
                Terima kasih kerana mendaftar! Sebelum meneruskan, sila sahkan alamat emel anda dengan menekan pautan yang telah dihantar ke
                <span class="email-highlight">{{ auth()->user()->email }}</span>.
            </p>
            <p style="margin-top: 8px;">
                Jika anda tidak menerima emel tersebut, kami akan menghantar semula dengan senang hati.
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="status-msg">
                    Pautan pengesahan baharu telah dihantar ke alamat emel yang anda berikan semasa pendaftaran.
                </div>
            @endif

            <div class="actions">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">Hantar Semula Emel</button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">Log Keluar</button>
                </form>
            </div>
        </div>

    </div>

</body>
</html>
