@props(['active' => 'dashboard'])

@php
$navItems = [
    ['key' => 'dashboard', 'label' => 'Dashboard', 'href' => route('dashboard'), 'icon' => '<rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>'],
    ['key' => 'tempahan', 'label' => 'Tempahan', 'href' => route('pending-booking'), 'icon' => '<path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>', 'children' => [
        ['key' => 'tempahan-kelulusan', 'label' => 'Kelulusan Tempahan', 'href' => route('pending-booking')],
        ['key' => 'tempahan-semua', 'label' => 'Semua Tempahan', 'href' => route('all-booking')],
    ]],
    ['key' => 'kalender', 'label' => 'Kalender', 'href' => route('kalendar.index'), 'icon' => '<rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>'],
    ['key' => 'pemberitahuan', 'label' => 'Pemberitahuan', 'href' => route('pemberitahuan.index'), 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>'],
    ['key' => 'dapur',   'label' => 'Dapur',   'href' => route('dapur.index'), 'icon' => '<path d="M3 12h18M3 6h18M3 18h18"/><circle cx="6" cy="6" r="1" fill="currentColor"/><circle cx="6" cy="12" r="1" fill="currentColor"/><circle cx="6" cy="18" r="1" fill="currentColor"/>'],
    ['key' => 'pengguna', 'label' => 'Pengguna', 'href' => route('pengguna.index'), 'icon' => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>'],
    ['key' => 'laporan', 'label' => 'Laporan', 'href' => '#', 'icon' => '<path d="M9 17v-2m3 2v-4m3 4v-6M5 21h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2z"/>', 'children' => [
        ['key' => 'laporan-rekod', 'label' => 'Rekod Peralatan & Barang', 'href' => route('laporan.rekod')],
        ['key' => 'laporan-maklumbalas', 'label' => 'Maklum Balas Pengguna', 'href' => route('laporan.maklumbalas')],
    ]],
];

$pendingCount = \DB::table('bookings')->where('status', 'pending')->count();
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

    .pending-badge {
        background: #ef4444;
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        border-radius: 999px;
        min-width: 18px;
        height: 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 5px;
        margin-left: auto;
    }

    .nav-sub-item .pending-badge {
        margin-left: 8px;
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

    .nav-sub-wrap {
        overflow: hidden;
        transition: max-height 0.2s ease;
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
        overflow: hidden;
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
        <img src="{{ asset('images/logo-upsi2.png') }}" alt="UPSI Logo">
        <span class="brand-name">Dapur Siswa Madani<br><span class="brand-sub">UPSI</span></span>
    </div>

    <nav class="sidebar-nav">
        @foreach ($navItems as $item)
            @php
                $hasChildren = !empty($item['children']);
                $isParentActive = $hasChildren ? \Illuminate\Support\Str::startsWith($active, $item['key'] . '-') : false;
                $isActive = $active === $item['key'] || $isParentActive;
            @endphp
            <a href="{{ $hasChildren ? 'javascript:void(0)' : $item['href'] }}" class="nav-item @if($isActive) active @endif" @if($hasChildren) onclick="toggleSubmenu(this)" @endif>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">{!! $item['icon'] !!}</svg>
                <span>{{ $item['label'] }}</span>
                @if($item['key'] === 'tempahan' && $pendingCount > 0)
                    <span class="pending-badge" id="tempahanBadge">{{ $pendingCount }}</span>
                @endif
                @if($hasChildren)
                    <svg class="nav-chevron" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M5 15l7-7 7 7"/></svg>
                @endif
            </a>
            <div class="nav-sub-wrap" @if(!$isParentActive && !$isActive) style="display:none;" @endif>
                @if($hasChildren)
                    @foreach ($item['children'] as $child)
                        <a href="{{ $child['href'] }}" class="nav-sub-item @if($active === $child['key']) active @endif">
                            <span>{{ $child['label'] }}</span>
                        </a>
                    @endforeach
                @endif
            </div>
        @endforeach
    </nav>

    <div class="sidebar-user">
        <div class="user-avatar">
            @if (auth()->user()->avatarUrl())
                <img src="{{ auth()->user()->avatarUrl() }}" alt="Avatar" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
            @else
                {{ auth()->user()->avatarInitial() }}
            @endif
        </div>
        <div class="user-info">
            <div class="u-name">{{ auth()->user()->name }}</div>
            <div class="u-role">Admin</div>
        </div>

    </div>
</aside>

<script>
    function toggleSubmenu(el) {
        var wrap = el.nextElementSibling;
        if (wrap) {
            var isOpen = wrap.style.display !== 'none';
            wrap.style.display = isOpen ? 'none' : 'block';
            var chevron = el.querySelector('.nav-chevron');
            if (chevron) {
                chevron.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
            }
            var badge = document.getElementById('tempahanBadge');
            if (badge) {
                if (isOpen) {
                    var parentSpan = el.querySelector('span');
                    if (parentSpan) parentSpan.after(badge);
                } else {
                    var firstSub = wrap.querySelector('.nav-sub-item');
                    if (firstSub) firstSub.querySelector('span').after(badge);
                }
            }
        }
    }
</script>
