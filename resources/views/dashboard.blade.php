<x-admin-layout active="dashboard">

    @section('title', 'Dashboard Tempahan – Dapur Siswa MADANI UPSI')

    @push('styles')
    <style>
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

        .content {
            padding: 28px;
            flex: 1;
        }

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

        .stat-icon.blue   { background: #1a56db; color: #fff; }
        .stat-icon.green  { background: #16a34a; color: #fff; }
        .stat-icon.amber  { background: #d97706; color: #fff; }
        .stat-icon.indigo { background: #4f46e5; color: #fff; }
        .stat-icon.red    { background: #dc2626; color: #fff; }

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

        .footer {
            text-align: center;
            padding: 16px 28px;
            font-size: 12px;
            color: #9ca3af;
            border-top: 1px solid #e5e7eb;
            background: #fff;
        }

        @media (max-width: 900px) {
            .stat-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 640px) {
            .stat-grid { grid-template-columns: 1fr 1fr; }
            .content { padding: 16px; }
        }
    </style>
    @endpush

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
                <div class="stat-body">
                    <div class="stat-num">12</div>
                    <div class="stat-label">Tempahan Hari Ini</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-body">
                    <div class="stat-num">48</div>
                    <div class="stat-label">Tempahan Bulan Ini</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-body">
                    <div class="stat-num">5</div>
                    <div class="stat-label">Menunggu Kelulusan</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-body">
                    <div class="stat-num">43</div>
                    <div class="stat-label">Disahkan</div>
                </div>
            </div>

            <div class="stat-card">
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

    </main>

    <footer class="footer">
        &copy; 2024 Dapur Siswa Madani UPSI. Hak Cipta Terpelihara.
    </footer>

</x-admin-layout>
