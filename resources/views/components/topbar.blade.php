@props(['title' => 'Dashboard', 'subtitle' => 'Sistem Tempahan Dapur Siswa Madani UPSI'])

<header class="topbar">
    <div class="topbar-titles">
        <h1>{{ $title }}</h1>
        <p>{{ $subtitle }}</p>
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
