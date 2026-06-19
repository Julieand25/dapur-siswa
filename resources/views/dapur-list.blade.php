<x-admin-layout active="dapur" title="Senarai Dapur" subtitle="Urus dan pantau semua dapur yang berdaftar dalam sistem.">

    @push('styles')
    <style>
        .content {
            padding: 28px;
            flex: 1;
        }

        .search-row {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
            align-items: center;
            flex-wrap: wrap;
        }

        .btn-tambah {
            height: 40px;
            padding: 0 20px;
            border: none;
            border-radius: 6px;
            font-size: 13.5px;
            font-weight: 700;
            color: #fff;
            background: #1a56db;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background 0.15s;
            text-decoration: none;
        }

        .btn-tambah:hover { background: #1e40af; }

        .btn-tambah svg {
            width: 16px;
            height: 16px;
        }

        .search-row {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
            align-items: center;
        }

        .search-box {
            position: relative;
            flex: 1;
            max-width: 360px;
        }

        .search-box input {
            width: 100%;
            padding: 9px 12px 9px 36px;
            border: 1.5px solid #d1d5db;
            border-radius: 6px;
            font-size: 13px;
            outline: none;
            transition: border-color 0.15s;
        }

        .search-box input:focus { border-color: #1a56db; }

        .search-box svg {
            position: absolute;
            left: 10px; top: 50%;
            transform: translateY(-50%);
            width: 15px; height: 15px;
            color: #9ca3af;
        }

        .filter-select {
            padding: 9px 30px 9px 12px;
            border: 1.5px solid #d1d5db;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6' viewBox='0 0 10 6'%3E%3Cpath d='M1 1l4 4 4-4' stroke='%236b7280' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E") no-repeat right 10px center;
            appearance: none;
            -webkit-appearance: none;
            outline: none;
            cursor: pointer;
        }

        .dapur-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .dapur-card {
            background: #fff;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            padding: 20px 22px;
            transition: box-shadow 0.2s, border-color 0.2s;
            cursor: pointer;
        }

        .dapur-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            border-color: #cbd5e1;
        }

        .card-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 8px;
        }

        .card-menu {
            position: relative;
        }

        .menu-dots {
            width: 30px;
            height: 30px;
            border: none;
            border-radius: 6px;
            background: transparent;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 3px;
            padding: 0;
            transition: background 0.15s;
        }

        .menu-dots:hover { background: #f3f4f6; }

        .menu-dots span {
            width: 3.5px;
            height: 3.5px;
            border-radius: 50%;
            background: #9ca3af;
        }

        .menu-dropdown {
            display: none;
            position: absolute;
            right: 0;
            top: 34px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.12);
            z-index: 20;
            min-width: 140px;
            overflow: hidden;
        }

        .menu-dropdown.show { display: block; }

        .menu-item {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            font-size: 13px;
            font-weight: 500;
            color: #374151;
            background: #fff;
            border: none;
            cursor: pointer;
            transition: background 0.1s;
            text-align: left;
        }

        .menu-item:hover { background: #f9fafb; }

        .menu-item.delete-item { color: #dc2626; }

        .menu-item.delete-item:hover { background: #fef2f2; }

        .menu-item svg {
            width: 14px;
            height: 14px;
            flex-shrink: 0;
        }

        .card-location {
            font-size: 11.5px;
            font-weight: 700;
            color: #4b5563;
            background: #f3f4f6;
            padding: 3px 9px;
            border-radius: 4px;
            letter-spacing: 0.3px;
        }

        .card-name {
            font-size: 15.5px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 4px;
            padding-bottom: 16px;
        }



        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 14px;
            border-top: 1px solid #f3f4f6;
        }

        .badge-tersedia {
            font-size: 11px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 999px;
            background: #ecfdf5;
            color: #059669;
            border: 1px solid #a7f3d0;
        }

        .badge-tidak-tersedia {
            font-size: 11px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 999px;
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .footer {
            text-align: center;
            padding: 16px 28px;
            font-size: 12px;
            color: #9ca3af;
            border-top: 1px solid #e5e7eb;
            background: #fff;
            margin-top: auto;
        }

        @media (max-width: 1200px) {
            .dapur-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 768px) {
            .dapur-grid { grid-template-columns: 1fr; }
            .search-row { flex-direction: column; }
            .search-box { max-width: 100%; }
        }

        @media (max-width: 640px) {
            .content { padding: 16px; }
        }
    </style>
    @endpush

    <main class="content">
        <div class="search-row">
            <div class="search-box" style="flex:1;max-width:100%;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                <input type="text" placeholder="Cari dapur...">
            </div>
            <select class="filter-select">
                <option>Semua Lokasi</option>
                <option>KHAR 4</option>
                <option>KHAR 3</option>
                <option>KHAR 2</option>
            </select>
            <select class="filter-select">
                <option>Semua Status</option>
                <option>Tersedia</option>
                <option>Tidak Tersedia</option>
            </select>
            <a href="{{ route('dapur.create') }}" class="btn-tambah" style="flex-shrink:0;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Tambah Dapur
            </a>
        </div>

        <div class="dapur-grid">
            <div class="dapur-card" onclick="location.href='{{ route('dapur.barang', 1) }}'">
                <div class="card-top">
                    <span class="card-location">KHAR 4</span>
                    <div class="card-menu">
                        <button class="menu-dots" onclick="toggleMenu(event)">
                            <span></span><span></span><span></span>
                        </button>
                        <div class="menu-dropdown">
                            <button class="menu-item" onclick="event.stopPropagation(); location.href='{{ route('dapur.edit', 1) }}'">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                Edit Dapur
                            </button>
                            <button class="menu-item delete-item" onclick="confirmDeleteDapur(event, 'Dapur 1')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                Padam
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-name">Dapur 1</div>

                <div class="card-footer">
                    <span class="badge-tersedia">Tersedia</span>
                </div>
            </div>

            <div class="dapur-card" onclick="location.href='{{ route('dapur.barang', 2) }}'">
                <div class="card-top">
                    <span class="card-location">KHAR 4</span>
                    <div class="card-menu">
                        <button class="menu-dots" onclick="toggleMenu(event)">
                            <span></span><span></span><span></span>
                        </button>
                        <div class="menu-dropdown">
                            <button class="menu-item" onclick="event.stopPropagation(); location.href='{{ route('dapur.edit', 2) }}'">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                Edit Dapur
                            </button>
                            <button class="menu-item delete-item" onclick="confirmDeleteDapur(event, 'Dapur 2')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                Padam
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-name">Dapur 2</div>

                <div class="card-footer">
                    <span class="badge-tersedia">Tersedia</span>
                </div>
            </div>

            <div class="dapur-card" onclick="location.href='{{ route('dapur.barang', 3) }}'">
                <div class="card-top">
                    <span class="card-location">KHAR 3</span>
                    <div class="card-menu">
                        <button class="menu-dots" onclick="toggleMenu(event)">
                            <span></span><span></span><span></span>
                        </button>
                        <div class="menu-dropdown">
                            <button class="menu-item" onclick="event.stopPropagation(); location.href='{{ route('dapur.edit', 3) }}'">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                Edit Dapur
                            </button>
                            <button class="menu-item delete-item" onclick="confirmDeleteDapur(event, 'Dapur 1')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                Padam
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-name">Dapur 1</div>

                <div class="card-footer">
                    <span class="badge-tidak-tersedia">Tidak Tersedia</span>
                </div>
            </div>

            <div class="dapur-card" onclick="location.href='{{ route('dapur.barang', 4) }}'">
                <div class="card-top">
                    <span class="card-location">KHAR 3</span>
                    <div class="card-menu">
                        <button class="menu-dots" onclick="toggleMenu(event)">
                            <span></span><span></span><span></span>
                        </button>
                        <div class="menu-dropdown">
                            <button class="menu-item" onclick="event.stopPropagation(); location.href='{{ route('dapur.edit', 4) }}'">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                Edit Dapur
                            </button>
                            <button class="menu-item delete-item" onclick="confirmDeleteDapur(event, 'Dapur 2')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                Padam
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-name">Dapur 2</div>

                <div class="card-footer">
                    <span class="badge-tersedia">Tersedia</span>
                </div>
            </div>
            <div class="dapur-card" onclick="location.href='{{ route('dapur.barang', 5) }}'">
                <div class="card-top">
                    <span class="card-location">KHAR 2</span>
                    <div class="card-menu">
                        <button class="menu-dots" onclick="toggleMenu(event)">
                            <span></span><span></span><span></span>
                        </button>
                        <div class="menu-dropdown">
                            <button class="menu-item" onclick="event.stopPropagation(); location.href='{{ route('dapur.edit', 5) }}'">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                Edit Dapur
                            </button>
                            <button class="menu-item delete-item" onclick="confirmDeleteDapur(event, 'Dapur 1')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                Padam
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-name">Dapur 1</div>

                <div class="card-footer">
                    <span class="badge-tersedia">Tersedia</span>
                </div>
            </div>
            <div class="dapur-card" onclick="location.href='{{ route('dapur.barang', 6) }}'">
                <div class="card-top">
                    <span class="card-location">KHAR 2</span>
                    <div class="card-menu">
                        <button class="menu-dots" onclick="toggleMenu(event)">
                            <span></span><span></span><span></span>
                        </button>
                        <div class="menu-dropdown">
                            <button class="menu-item" onclick="event.stopPropagation(); location.href='{{ route('dapur.edit', 6) }}'">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                Edit Dapur
                            </button>
                            <button class="menu-item delete-item" onclick="confirmDeleteDapur(event, 'Dapur 2')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                Padam
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-name">Dapur 2</div>

                <div class="card-footer">
                    <span class="badge-tidak-tersedia">Tidak Tersedia</span>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer">
        &copy; 2024 Dapur Siswa Madani UPSI. Hak Cipta Terpelihara.
    </footer>

    <script>
        function toggleMenu(e) {
            e.stopPropagation();
            var dropdown = e.currentTarget.nextElementSibling;
            var isOpen = dropdown.classList.contains('show');
            document.querySelectorAll('.menu-dropdown.show').forEach(function(d) { d.classList.remove('show'); });
            if (!isOpen) dropdown.classList.add('show');
        }

        function confirmDeleteDapur(e, name) {
            e.stopPropagation();
            document.querySelectorAll('.menu-dropdown.show').forEach(function(d) { d.classList.remove('show'); });
            alert('Padam ' + name + '?');
        }

        document.addEventListener('click', function() {
            document.querySelectorAll('.menu-dropdown.show').forEach(function(d) { d.classList.remove('show'); });
        });
    </script>

</x-admin-layout>
