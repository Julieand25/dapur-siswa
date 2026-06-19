<x-admin-layout active="dashboard" title="Dashboard Tempahan" subtitle="Sistem Tempahan Dapur Siswa Madani UPSI">

    @push('styles')
    <style>
        .content {
            padding: 28px;
            flex: 1;
        }

        .stat-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
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
                    <div class="stat-num">5</div>
                    <div class="stat-label">Menunggu Kelulusan</div>
                </div>
            </div>

        </div>

        <!-- Table Card -->
        <div class="table-card">

            <!-- Toolbar -->
            <div class="table-toolbar">
                <div class="search-wrap">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                        <input type="text" placeholder="Cari nama, lokasi, atau tujuan…">
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
                        <th>Pemohon</th>
                        <th>No. Matrik</th>
                        <th>Emel</th>
                        <th>Lokasi</th>
                        <th>Dapur</th>
                        <th>Tarikh</th>
                        <th>Masa</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Hafizul Hakim</td>
                        <td>D20240000001</td>
                        <td>hafizul@siswa.edu.my</td>
                        <td>KHAR</td>
                        <td>Dapur 1</td>
                        <td>13/05/2024</td>
                        <td>08:00 – 12:00</td>
                        <td><span class="badge badge-disahkan">Disahkan</span></td>
                    </tr>
                    <tr>
                        <td>Nur Aisyah</td>
                        <td>D20240000002</td>
                        <td>aisyah@siswa.edu.my</td>
                        <td>KHAR</td>
                        <td>Dapur 2</td>
                        <td>13/05/2024</td>
                        <td>13:00 – 17:00</td>
                        <td><span class="badge badge-menunggu">Menunggu</span></td>
                    </tr>
                    <tr>
                        <td>Muhammad Iqbal</td>
                        <td>D20240000003</td>
                        <td>iqbal@siswa.edu.my</td>
                        <td>KHAR</td>
                        <td>Dapur 1</td>
                        <td>14/05/2024</td>
                        <td>08:00 – 12:00</td>
                        <td><span class="badge badge-disahkan">Disahkan</span></td>
                    </tr>
                    <tr>
                        <td>Siti Nur Farhana</td>
                        <td>D20240000004</td>
                        <td>farhana@siswa.edu.my</td>
                        <td>KHAR</td>
                        <td>Dapur 3</td>
                        <td>14/05/2024</td>
                        <td>14:00 – 18:00</td>
                        <td><span class="badge badge-menunggu">Menunggu</span></td>
                    </tr>
                    <tr>
                        <td>Ahmad Danial</td>
                        <td>D20240000005</td>
                        <td>danial@siswa.edu.my</td>
                        <td>KHAR</td>
                        <td>Dapur 2</td>
                        <td>15/05/2024</td>
                        <td>10:00 – 15:00</td>
                        <td><span class="badge badge-dibatalkan">Dibatalkan</span></td>
                    </tr>
                    <tr>
                        <td>Norsyafiqah</td>
                        <td>D20240000006</td>
                        <td>syafiqah@siswa.edu.my</td>
                        <td>KHAR</td>
                        <td>Dapur 1</td>
                        <td>15/05/2024</td>
                        <td>08:00 – 12:00</td>
                        <td><span class="badge badge-disahkan">Disahkan</span></td>
                    </tr>
                    <tr>
                        <td>Intan Maisarah</td>
                        <td>D20240000007</td>
                        <td>intan@siswa.edu.my</td>
                        <td>KHAR</td>
                        <td>Dapur 3</td>
                        <td>16/05/2024</td>
                        <td>09:00 – 13:00</td>
                        <td><span class="badge badge-menunggu">Menunggu</span></td>
                    </tr>
                    <tr>
                        <td>Akmal Hakimi</td>
                        <td>D20240000008</td>
                        <td>akmal@siswa.edu.my</td>
                        <td>KHAR</td>
                        <td>Dapur 2</td>
                        <td>16/05/2024</td>
                        <td>14:00 – 17:00</td>
                        <td><span class="badge badge-disahkan">Disahkan</span></td>
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
