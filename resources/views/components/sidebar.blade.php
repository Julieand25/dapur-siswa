@props(['active' => 'dashboard'])

@php
$navItems = [
    ['key' => 'dashboard', 'label' => 'Dashboard', 'href' => route('dashboard'), 'icon' => '<rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>'],
    ['key' => 'tempahan', 'label' => 'Tempahan', 'href' => route('pending-booking'), 'icon' => '<path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>', 'children' => [
        ['key' => 'tempahan-kelulusan', 'label' => 'Kelulusan Tempahan', 'href' => route('pending-booking')],
        ['key' => 'tempahan-semua', 'label' => 'Semua Tempahan', 'href' => '#'],
    ]],
    ['key' => 'kalender', 'label' => 'Kalender', 'href' => route('kalendar.index'), 'icon' => '<rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>'],
    ['key' => 'dapur',   'label' => 'Dapur',   'href' => route('dapur.index'), 'icon' => '<path d="M3 12h18M3 6h18M3 18h18"/><circle cx="6" cy="6" r="1" fill="currentColor"/><circle cx="6" cy="12" r="1" fill="currentColor"/><circle cx="6" cy="18" r="1" fill="currentColor"/>'],
    ['key' => 'peralatan', 'label' => 'Peralatan', 'href' => '#', 'icon' => '<path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/>'],
    ['key' => 'pengguna', 'label' => 'Pengguna', 'href' => route('pengguna.index'), 'icon' => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>'],
    ['key' => 'laporan', 'label' => 'Laporan', 'href' => '#', 'icon' => '<path d="M9 17v-2m3 2v-4m3 4v-6M5 21h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2z"/>'],
    ['key' => 'notifikasi', 'label' => 'Notifikasi', 'href' => '#', 'icon' => '<path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>'],
    ['key' => 'tetapan', 'label' => 'Tetapan', 'href' => '#', 'icon' => '<path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/>'],
];
@endphp

<style>
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

    .nav-chevron {
        margin-left: auto;
        width: 12px;
        height: 12px;
        opacity: 0.4;
        flex-shrink: 0;
        transition: transform 0.2s;
    }

    .nav-item.active .nav-chevron {
        transform: rotate(180deg);
        opacity: 0.7;
    }

    .nav-sub-item {
        display: flex;
        align-items: center;
        padding: 8px 18px 8px 42px;
        font-size: 12px;
        font-weight: 500;
        color: rgba(255,255,255,0.65);
        text-decoration: none;
        cursor: pointer;
        border-left: 3px solid transparent;
        transition: background 0.15s, color 0.15s;
    }

    .nav-sub-item:hover {
        background: rgba(255,255,255,0.08);
        color: #fff;
    }

    .nav-sub-item.active {
        background: rgba(255,255,255,0.12);
        color: #fff;
        border-left-color: #60a5fa;
        font-weight: 600;
    }

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

    @media (max-width: 640px) {
        .sidebar { width: 56px; }
        .sidebar-logo .brand-name, .sidebar-logo .brand-sub,
        .nav-item span, .nav-sub-item, .user-info, .chevron-btn { display: none; }
    }
</style>

<aside class="sidebar">
    <div class="sidebar-logo">
        <img src="{{ asset('images/upsi-logo.png') }}" alt="UPSI Logo">
        <span class="brand-name">Dapur Siswa Madani<br><span class="brand-sub">UPSI</span></span>
    </div>

    <nav class="sidebar-nav">
        @foreach ($navItems as $item)
            @php
                $hasChildren = !empty($item['children']);
                $isParentActive = $hasChildren ? \Illuminate\Support\Str::startsWith($active, $item['key'] . '-') : false;
                $isActive = $active === $item['key'] || $isParentActive;
            @endphp
            <a href="{{ $item['href'] }}" class="nav-item @if($isActive) active @endif">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">{!! $item['icon'] !!}</svg>
                <span>{{ $item['label'] }}</span>
                @if($hasChildren && ($isParentActive || $isActive))
                    <svg class="nav-chevron" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M5 15l7-7 7 7"/></svg>
                @endif
            </a>
            @if($hasChildren && ($isParentActive || $isActive))
                @foreach ($item['children'] as $child)
                    <a href="{{ $child['href'] }}" class="nav-sub-item @if($active === $child['key']) active @endif">
                        <span>{{ $child['label'] }}</span>
                    </a>
                @endforeach
            @endif
        @endforeach
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
