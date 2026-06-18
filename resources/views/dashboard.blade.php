<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Tempahan – Dapur Siswa MADANI UPSI</title>
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

        /* ══════════════════════════════
           SIDEBAR
        ══════════════════════════════ */
        .sidebar {
            width: 160px;
            flex-shrink: 0;
            background: #1a3a8f;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            height: 100%;
            z-index: 100;
        }

        .sidebar-logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            padding: 20px 12px 16px;
            border-bottom: 1px solid rgba(255,255,255,0.12);
        }

        .sidebar-logo img {
            width: 44px;
            height: 44px;
            object-fit: contain;
            border-radius: 8px;
        }

        .sidebar-logo .brand-name {
            font-size: 12px;
            font-weight: 700;
            color: #fff;
            text-align: center;
            line-height: 1.35;
        }

        .sidebar-logo .brand-sub {
            font-size: 10px;
            color: rgba(255,255,255,0.6);
            font-weight: 500;
        }

        .sidebar-nav {
            flex: 1;
            padding: 12px 0;
            overflow-y: auto;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 18px;
            font-size: 13px;
            font-weight: 500;
            color: rgba(255,255,255,0.75);
            text-decoration: none;
            cursor: pointer;
            border-left: 3px solid transparent;
            transition: background 0.15s, color 0.15s;
        }

        .nav-item:hover {
            background: rgba(255,255,255,0.1);
            color: #fff;
        }

        .nav-item.active {
            background: rgba(255,255,255,0.15);
            color: #fff;
            border-left-color: #60a5fa;
            font-weight: 600;
        }

        .nav-item svg {
            width: 17px;
            height: 17px;
            flex-shrink: 0;
            opacity: 0.85;
        }

        .nav-item.active svg { opacity: 1; }

        /* User footer */
        .sidebar-user {
            padding: 14px 16px;
            border-top: 1px solid rgba(255,255,255,0.12);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #3b5fc0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .user-info { min-width: 0; }
        .user-info .u-name {
            font-size: 12px;
            font-weight: 700;
            color: #fff;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .user-info .u-role {
            font-size: 10.5px;
            color: rgba(255,255,255,0.55);
        }

        .chevron-btn {
            margin-left: auto;
            background: none;
            border: none;
            color: rgba(255,255,255,0.5);
            cursor: pointer;
            padding: 2px;
        }

        /* ══════════════════════════════
           MAIN
        ══════════════════════════════ */
        .main {
            margin-left: 160px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ── Topbar ── */
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

        /* ── Content ── */
        .content {
            padding: 28px;
            flex: 1;
        }

        /* ── Stat Cards ── */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: #fff;
            border-radius: 10px;
            padding: 18px 20px;
            display: flex;
            align-items: center;
            gap: 14px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stat-icon svg { width: 22px; height: 22px; }

        .stat-icon.blue   { background: #eff6ff; color: #1a56db; }
        .stat-icon.green  { background: #f0fdf4; color: #16a34a; }
        .stat-icon.amber  { background: #fffbeb; color: #d97706; }
        .stat-icon.indigo { background: #eef2ff; color: #4f46e5; }
        .stat-icon.red    { background: #fef2f2; color: #dc2626; }

        .stat-body .stat-num {
            font-size: 26px;
            font-weight: 700;
            color: #111827;
            line-height: 1.1;
        }

        .stat-body .stat-label {
            font-size: 11.5px;
            color: #6b7280;
            margin-top: 3px;
            font-weight: 500;
        }

        /* ── Table Card ── */
        .table-card {
            background: #fff;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        .table-toolbar {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 16px 20px;
            border-bottom: 1px solid #f3f4f6;
            flex-wrap: wrap;
        }

        .search-wrap {
            position: relative;
            flex: 1;
            min-width: 200px;
            max-width: 300px;
        }

        .search-wrap input {
            width: 100%;
            padding: 9px 12px 9px 36px;
            border: 1.5px solid #d1d5db;
            border-radius: 6px;
            font-size: 13px;
            color: #374151;
            outline: none;
            transition: border-color 0.15s;
            background: #fff;
        }

        .search-wrap input:focus { border-color: #1a56db; }

        .search-wrap svg {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            width: 15px;
            height: 15px;
            color: #9ca3af;
        }

        .filter-select {
            padding: 9px 28px 9px 10px;
            border: 1.5px solid #d1d5db;
            border-radius: 6px;
            font-size: 13px;
            color: #374151;
            background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6' viewBox='0 0 10 6'%3E%3Cpath d='M1 1l4 4 4-4' stroke='%236b7280' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E") no-repeat right 10px center;
            appearance: none;
            -webkit-appearance: none;
            outline: none;
            cursor: pointer;
        }

        .date-input {
            padding: 9px 10px;
            border: 1.5px solid #d1d5db;
            border-radius: 6px;
            font-size: 13px;
            color: #374151;
            outline: none;
            background: #fff;
        }


        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13.5px;
        }

        thead tr {
            background: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
        }

        thead th {
            padding: 12px 16px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            white-space: nowrap;
        }

        tbody tr {
            border-bottom: 1px solid #f3f4f6;
            transition: background 0.1s;
        }

        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: #f9fafb; }

        tbody td {
            padding: 13px 16px;
            color: #374151;
            vertical-align: middle;
        }

        tbody td:nth-last-child(2),
        tbody td:last-child,
        thead th:nth-last-child(2),
        thead th:last-child {
            text-align: center;
        }

        tbody td:first-child {
            font-weight: 600;
            color: #1a3a8f;
        }

        /* Status badges */
        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 100px;
            padding: 3px 10px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .badge-disahkan  { background: #15803d; color: #fff; }
        .badge-menunggu  { background: #ca8a04; color: #fff; }
        .badge-dibatalkan{ background: #b91c1c; color: #fff; }

        /* Action buttons */
        .action-wrap { display: flex; align-items: center; justify-content: center; gap: 6px; }

        .action-btn {
            width: 30px;
            height: 30px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: filter 0.15s;
        }

        .action-btn:hover { filter: brightness(0.9); }
        .action-btn svg { width: 14px; height: 14px; }

        .action-btn.edit   { background: #f3f4f6; color: #111827; }

        /* Pagination */
        .pagination {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 20px;
            border-top: 1px solid #f3f4f6;
        }

        .pag-info {
            font-size: 12.5px;
            color: #6b7280;
        }

        .pag-pages {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .pag-btn {
            width: 30px;
            height: 30px;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
            background: #fff;
            font-size: 12.5px;
            color: #374151;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            transition: background 0.12s;
        }

        .pag-btn:hover { background: #f3f4f6; }
        .pag-btn.active { background: #1a56db; color: #fff; border-color: #1a56db; font-weight: 700; }
        .pag-btn svg { width: 13px; height: 13px; }

        /* Footer */
        .footer {
            text-align: center;
            padding: 16px 28px;
            font-size: 12px;
            color: #9ca3af;
            border-top: 1px solid #e5e7eb;
            background: #fff;
        }

        /* ── Responsive ── */
        @media (max-width: 900px) {
            .stat-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 640px) {
            .sidebar { width: 56px; }
            .sidebar-logo .brand-name, .sidebar-logo .brand-sub,
            .nav-item span, .user-info, .chevron-btn { display: none; }
            .main { margin-left: 56px; }
            .stat-grid { grid-template-columns: 1fr 1fr; }
            .content { padding: 16px; }
        }
    </style>
</head>
<body>

    <!-- ══ SIDEBAR ══ -->
    <aside class="sidebar">

        <div class="sidebar-logo">
            <img src="{{ asset('images/upsi-logo.png') }}" alt="UPSI Logo">
            <span class="brand-name">Dapur Siswa Madani<br><span class="brand-sub">UPSI</span></span>
        </div>

        <nav class="sidebar-nav">

            <a href="#" class="nav-item active">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                <span>Dashboard</span>
            </a>

            <a href="#" class="nav-item">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                <span>Tempahan</span>
            </a>

            <a href="#" class="nav-item">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                <span>Kalender</span>
            </a>

            <a href="#" class="nav-item">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3 12h18M3 6h18M3 18h18"/><circle cx="6" cy="6" r="1" fill="currentColor"/><circle cx="6" cy="12" r="1" fill="currentColor"/><circle cx="6" cy="18" r="1" fill="currentColor"/></svg>
                <span>Dapur</span>
            </a>

            <a href="#" class="nav-item">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/></svg>
                <span>Peralatan</span>
            </a>

            <a href="#" class="nav-item">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
                <span>Pengguna</span>
            </a>

            <a href="#" class="nav-item">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 17v-2m3 2v-4m3 4v-6M5 21h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                <span>Laporan</span>
            </a>

            <a href="#" class="nav-item">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                <span>Notifikasi</span>
            </a>

            <a href="#" class="nav-item">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/></svg>
                <span>Tetapan</span>
            </a>

        </nav>

        <div class="sidebar-user">
            <div class="user-avatar">P</div>
            <div class="user-info">
                <div class="u-name">Pentadbir</div>
                <div class="u-role">Admin</div>
            </div>
            <button class="chevron-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M5 9l7 7 7-7"/></svg>
            </button>
        </div>

    </aside>

    <!-- ══ MAIN ══ -->
    <div class="main">

        <!-- Topbar -->
        <header class="topbar">
            <div class="topbar-titles">
                <h1>Dashboard Tempahan</h1>
                <p>Sistem Tempahan Dapur Siswa Madani UPSI</p>
            </div>
            <div class="topbar-right">
                <button class="notif-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    <span class="notif-badge">3</span>
                </button>
                <div class="topbar-user">
                    <div class="topbar-user-text">
                        <div class="greet">Selamat datang,</div>
                        <div class="name">Pentadbir</div>
                    </div>
                    <div class="topbar-avatar">P</div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M5 9l7 7 7-7"/></svg>
                </div>
            </div>
        </header>

        <!-- Content -->
        <main class="content">

            <!-- Stat Cards -->
            <div class="stat-grid">

                <div class="stat-card">
                    <div class="stat-icon blue">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                    </div>
                    <div class="stat-body">
                        <div class="stat-num">12</div>
                        <div class="stat-label">Tempahan Hari Ini</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon green">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                    </div>
                    <div class="stat-body">
                        <div class="stat-num">48</div>
                        <div class="stat-label">Tempahan Bulan Ini</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon amber">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                    </div>
                    <div class="stat-body">
                        <div class="stat-num">5</div>
                        <div class="stat-label">Menunggu Kelulusan</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon indigo">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="stat-body">
                        <div class="stat-num">43</div>
                        <div class="stat-label">Disahkan</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon red">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M15 9l-6 6M9 9l6 6"/></svg>
                    </div>
                    <div class="stat-body">
                        <div class="stat-num">2</div>
                        <div class="stat-label">Dibatalkan</div>
                    </div>
                </div>

            </div>

            <!-- Table Card -->
            <div class="table-card">

                <!-- Toolbar -->
                <div class="table-toolbar">
                    <div class="search-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                        <input type="text" placeholder="Cari nama, program, atau tujuan…">
                    </div>

                    <select class="filter-select">
                        <option>Semua Dapur</option>
                        <option>Dapur 1</option>
                        <option>Dapur 2</option>
                        <option>Dapur 3</option>
                    </select>

                    <select class="filter-select">
                        <option>Semua Status</option>
                        <option>Disahkan</option>
                        <option>Menunggu</option>
                        <option>Dibatalkan</option>
                    </select>

                    <input type="date" class="date-input" value="2024-05-13">


                </div>

                <!-- Table -->
                <table>
                    <thead>
                        <tr>
                            <th>ID Tempahan</th>
                            <th>Pemohon</th>
                            <th>Program / Tujuan</th>
                            <th>Tarikh</th>
                            <th>Masa</th>
                            <th>Dapur</th>
                            <th>Status</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>BK240513-001</td>
                            <td>Hafizul Hakim</td>
                            <td>Program Masakan Sihat</td>
                            <td>13/05/2024</td>
                            <td>08:00 – 12:00</td>
                            <td>Dapur 1</td>
                            <td><span class="badge badge-disahkan">Disahkan</span></td>
                            <td>
                                <div class="action-wrap">
                                    <button class="action-btn edit" title="Sunting">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>BK240513-002</td>
                            <td>Nur Aisyah</td>
                            <td>Kursus Bakeri</td>
                            <td>13/05/2024</td>
                            <td>13:00 – 17:00</td>
                            <td>Dapur 2</td>
                            <td><span class="badge badge-menunggu">Menunggu</span></td>
                            <td>
                                <div class="action-wrap">
                                    <button class="action-btn edit" title="Sunting">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>BK240514-003</td>
                            <td>Muhammad Iqbal</td>
                            <td>Aktiviti Kelab Kulinari</td>
                            <td>14/05/2024</td>
                            <td>08:00 – 12:00</td>
                            <td>Dapur 1</td>
                            <td><span class="badge badge-disahkan">Disahkan</span></td>
                            <td>
                                <div class="action-wrap">
                                    <button class="action-btn edit" title="Sunting">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>BK240514-004</td>
                            <td>Siti Nur Farhana</td>
                            <td>Pertandingan Memasak</td>
                            <td>14/05/2024</td>
                            <td>14:00 – 18:00</td>
                            <td>Dapur 3</td>
                            <td><span class="badge badge-menunggu">Menunggu</span></td>
                            <td>
                                <div class="action-wrap">
                                    <button class="action-btn edit" title="Sunting">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>BK240515-005</td>
                            <td>Ahmad Danial</td>
                            <td>Majlis Jamuan</td>
                            <td>15/05/2024</td>
                            <td>10:00 – 15:00</td>
                            <td>Dapur 2</td>
                            <td><span class="badge badge-dibatalkan">Dibatalkan</span></td>
                            <td>
                                <div class="action-wrap">
                                    <button class="action-btn edit" title="Sunting">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>BK240515-006</td>
                            <td>Norsyafiqah</td>
                            <td>Latihan Pengendalian Makanan</td>
                            <td>15/05/2024</td>
                            <td>08:00 – 12:00</td>
                            <td>Dapur 1</td>
                            <td><span class="badge badge-disahkan">Disahkan</span></td>
                            <td>
                                <div class="action-wrap">
                                    <button class="action-btn edit" title="Sunting">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>BK240516-007</td>
                            <td>Intan Maisarah</td>
                            <td>Program Kesedaran Sihat</td>
                            <td>16/05/2024</td>
                            <td>09:00 – 13:00</td>
                            <td>Dapur 3</td>
                            <td><span class="badge badge-menunggu">Menunggu</span></td>
                            <td>
                                <div class="action-wrap">
                                    <button class="action-btn edit" title="Sunting">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>BK240516-008</td>
                            <td>Akmal Hakimi</td>
                            <td>Kelas Kuih Tradisional</td>
                            <td>16/05/2024</td>
                            <td>14:00 – 17:00</td>
                            <td>Dapur 2</td>
                            <td><span class="badge badge-disahkan">Disahkan</span></td>
                            <td>
                                <div class="action-wrap">
                                    <button class="action-btn edit" title="Sunting">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="pagination">
                    <span class="pag-info">Memaparkan 1 hingga 8 daripada 48 rekod</span>
                    <div class="pag-pages">
                        <button class="pag-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>
                        </button>
                        <button class="pag-btn active">1</button>
                        <button class="pag-btn">2</button>
                        <button class="pag-btn">3</button>
                        <button class="pag-btn" disabled style="cursor:default;color:#9ca3af;">…</button>
                        <button class="pag-btn">6</button>
                        <button class="pag-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
                        </button>
                    </div>
                </div>

            </div>
            <!-- /table-card -->

        </main>

        <footer class="footer">
            © 2024 Dapur Siswa Madani UPSI. Hak Cipta Terpelihara.
        </footer>

    </div>

</body>
</html>
