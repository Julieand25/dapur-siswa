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
        <div class="user-menu-wrapper" id="userMenuWrapper">
            <div class="topbar-user">
                <div class="topbar-user-text">
                    <div class="greet">Selamat datang,</div>
                    <div class="name">{{ auth()->user()->name }}</div>
                </div>
                <div class="topbar-avatar" id="avatarBtn">
                    @if (auth()->user()->avatarUrl())
                        <img src="{{ auth()->user()->avatarUrl() }}" alt="Avatar" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                    @else
                        {{ auth()->user()->avatarInitial() }}
                    @endif
                </div>
            </div>
            <div class="user-dropdown" id="userDropdown" style="display:none;">
                <a href="{{ route('tetapan.index') }}" class="user-dropdown-item">Tetapan</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="user-dropdown-item logout">Log Keluar</button>
                </form>
            </div>
        </div>
    </div>
</header>

<script>
(function() {
    var btn = document.getElementById('avatarBtn');
    var dropdown = document.getElementById('userDropdown');
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
    });
    document.addEventListener('click', function(e) {
        if (!document.getElementById('userMenuWrapper').contains(e.target)) {
            dropdown.style.display = 'none';
        }
    });
})();
</script>
