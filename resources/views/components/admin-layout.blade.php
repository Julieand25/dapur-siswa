@props(['active' => 'dashboard', 'title' => 'Dashboard', 'subtitle' => 'Sistem Tempahan Dapur Siswa Madani UPSI'])

<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $title . ' – Dapur Siswa MADANI UPSI')</title>
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

        .topbar {
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            padding: 0 28px;
            height: 64px;
            display: flex;
            align-items: center;
            gap: 16px;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar-titles { flex: 1; }
        .topbar-titles h1 {
            font-size: 20px;
            font-weight: 700;
            color: #111827;
        }
        .topbar-titles p {
            font-size: 12.5px;
            color: #6b7280;
            margin-top: 1px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .notif-btn {
            position: relative;
            background: none;
            border: none;
            cursor: pointer;
            color: #6b7280;
            padding: 4px;
        }

        .notif-btn svg { width: 22px; height: 22px; }

        .notif-badge {
            position: absolute;
            top: -2px; right: -2px;
            background: #ef4444;
            color: #fff;
            font-size: 9px;
            font-weight: 700;
            border-radius: 999px;
            min-width: 16px;
            height: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 3px;
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .topbar-user-text { text-align: right; }
        .topbar-user-text .greet {
            font-size: 11px;
            color: #6b7280;
        }
        .topbar-user-text .name {
            font-size: 13px;
            font-weight: 700;
            color: #111827;
        }

        .topbar-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #1a3a8f;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 14px;
            font-weight: 700;
        }

        .user-menu-wrapper {
            position: relative;
        }

        .user-dropdown {
            position: absolute;
            right: 0;
            top: 100%;
            margin-top: 8px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            min-width: 160px;
            z-index: 100;
            overflow: hidden;
        }

        .user-dropdown-item {
            display: block;
            width: 100%;
            padding: 10px 16px;
            font-size: 13px;
            font-weight: 600;
            text-align: left;
            border: none;
            background: none;
            cursor: pointer;
        }

        .user-dropdown-item.logout {
            color: #dc2626;
        }

        .user-dropdown-item.logout:hover {
            background: #fef2f2;
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

        <x-topbar :title="$title" :subtitle="$subtitle" />

        {{ $slot }}
    </div>

</body>
</html>
