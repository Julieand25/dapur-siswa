@props(['title' => 'Dashboard', 'subtitle' => 'Sistem Tempahan Dapur Siswa Madani UPSI'])

<header class="topbar">
    <div class="topbar-titles">
        <h1>{{ $title }}</h1>
        <p>{{ $subtitle }}</p>
    </div>
    <div class="topbar-right">
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
