@props(['active' => 'dashboard'])

<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard – Dapur Siswa MADANI UPSI')</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f3f4f8;
            min-height: 100vh;
            display: flex;
            flex-direction: row;
            color: #111827;
        }

        .main {
            margin-left: 160px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        @media (max-width: 640px) {
            .main { margin-left: 56px; }
        }
    </style>
    @stack('styles')
</head>
<body>

    <x-sidebar :active="$active" />

    <div class="main">
        {{ $slot }}
    </div>

</body>
</html>
