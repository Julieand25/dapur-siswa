<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dapur Siswa MADANI UPSI</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            height: 100vh;
            overflow: hidden;
            display: flex;
        }

        /* ── Left Panel ── */
        .left-panel {
            width: 50%;
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 48px 40px;
            gap: 28px;
        }

        .logo-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
        }

        .logo-wrap img {
            width: 220px;
            max-width: 100%;
            object-fit: contain;
        }

        .tagline {
            text-align: center;
        }

        .tagline p {
            font-size: 15px;
            font-weight: 700;
            color: #1a3a8f;
            line-height: 1.45;
            letter-spacing: 0.01em;
        }

        /* Malaysia Madani badge */
        .madani-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 4px;
        }

        .madani-badge img {
            height: 36px;
            width: auto;
        }

        .madani-badge span {
            font-size: 13px;
            font-weight: 700;
            color: #c00;
            letter-spacing: 0.04em;
            line-height: 1.2;
        }

        /* ── Buttons ── */
        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 14px;
            width: 100%;
            max-width: 320px;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 14px 24px;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 600;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
            letter-spacing: 0.02em;
            transition: filter 0.15s ease, transform 0.1s ease;
        }

        .btn:hover {
            filter: brightness(1.08);
            transform: translateY(-1px);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn-primary {
            background-color: #1a56db;
            color: #ffffff;
            border: none;
        }

        .btn-secondary {
            background-color: #ffffff;
            color: #1a3a8f;
            border: 2px solid #1a3a8f;
        }

        /* ── Right Panel ── */
        .right-panel {
            width: 50%;
            overflow: hidden;
            position: relative;
        }

        .right-panel img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
        }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            body {
                flex-direction: column;
                overflow: auto;
                height: auto;
                min-height: 100vh;
            }

            .left-panel {
                width: 100%;
                padding: 40px 28px;
            }

            .right-panel {
                width: 100%;
                height: 240px;
                flex-shrink: 0;
            }
        }
    </style>
</head>
<body>

    {{-- ── Left: Login Panel ── --}}
    <div class="left-panel">

        {{-- Logo --}}
        <div class="logo-wrap">
            <img src="{{ asset('images/dapur-siswa-logo.png') }}" alt="Dapur Siswa MADANI UPSI Logo">

            <div class="tagline">
                <p>Sistem Tempahan Dapur Siswa<br>MADANI UPSI</p>
                {{-- Malaysia Madani badge (text fallback; swap for logo if available) --}}
                <div class="madani-badge">
                    {{-- Uncomment and add the Malaysia Madani seal if you have it:
                    <img src="{{ asset('images/malaysia-madani.png') }}" alt="Malaysia Madani"> --}}
                    <span>🇲🇾 MALAYSIA<br>MADANI</span>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="btn-group">
            <a href="{{ route('login') }}" class="btn btn-primary">Log Masuk</a>
            <a href="{{ route('register') }}" class="btn btn-secondary">Daftar Akaun</a>
        </div>

    </div>

    {{-- ── Right: Kitchen Photo ── --}}
    <div class="right-panel">
        <img src="{{ asset('images/dapur.png') }}" alt="Dapur Siswa Kitchen">
    </div>

</body>
</html>