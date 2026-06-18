<x-admin-layout active="tempahan-kelulusan" title="Kelulusan Tempahan" subtitle="Semak dan luluskan atau tolak permohonan tempahan dapur.">

    @push('styles')
    <style>
        .content {
            padding: 28px;
            flex: 1;
        }

        .split-grid {
            display: grid;
            grid-template-columns: 380px 1fr;
            gap: 24px;
            align-items: start;
        }

        .panel-card {
            background: #fff;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            padding: 24px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            max-height: calc(100vh - 250px);
        }

        .panel-title {
            font-size: 14.5px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .badge-count {
            background: #fef3c7;
            color: #d97706;
            font-size: 11px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 999px;
        }

        .search-filter-row {
            display: flex;
            gap: 8px;
            margin-bottom: 16px;
        }

        .search-box {
            position: relative;
            flex: 1;
        }

        .search-box input {
            width: 100%;
            padding: 9px 12px 9px 34px;
            border: 1.5px solid #d1d5db;
            border-radius: 6px;
            font-size: 12.5px;
            outline: none;
            transition: border-color 0.15s;
        }

        .search-box input:focus { border-color: #1a56db; }

        .search-box svg {
            position: absolute;
            left: 10px; top: 50%;
            transform: translateY(-50%);
            width: 14px; height: 14px;
            color: #9ca3af;
        }

        .filter-select {
            padding: 9px 28px 9px 10px;
            border: 1.5px solid #d1d5db;
            border-radius: 6px;
            font-size: 12.5px;
            font-weight: 600;
            color: #374151;
            background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6' viewBox='0 0 10 6'%3E%3Cpath d='M1 1l4 4 4-4' stroke='%236b7280' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E") no-repeat right 10px center;
            appearance: none;
            -webkit-appearance: none;
            outline: none;
            cursor: pointer;
        }

        .request-list-scroll {
            overflow-y: auto;
            flex: 1;
            min-height: 0;
            margin-bottom: 16px;
        }

        .request-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .request-item {
            border: 1px solid #e5e7eb;
            border-left: 4px solid transparent;
            border-radius: 0 8px 8px 0;
            padding: 14px 16px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background 0.15s, border-color 0.15s;
            text-decoration: none;
            color: inherit;
        }

        .request-item:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            border-left-color: #cbd5e1;
        }

        .request-item.selected {
            background: #eff6ff;
            border-color: #93c5fd;
            border-left-color: #3b82f6;
        }

        .req-meta {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .req-ref-row {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .req-submitted {
            font-size: 11px;
            font-weight: 500;
            color: #6b7280;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .req-submitted svg {
            width: 12px; height: 12px;
            color: #9ca3af;
        }

        .badge-status {
            font-size: 10px;
            font-weight: 700;
            background: #fff9db;
            color: #d97706;
            padding: 1px 6px;
            border-radius: 4px;
            border: 1px solid #fef08a;
        }

        .req-name {
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-top: 2px;
        }

        .req-details {
            font-size: 11.5px;
            color: #6b7280;
            display: flex;
            flex-direction: column;
            gap: 2px;
            margin-top: 4px;
        }

        .req-details span {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .req-details svg {
            width: 13px; height: 13px;
            color: #9ca3af;
        }

        .chevron-right svg {
            width: 16px; height: 16px;
            color: #9ca3af;
        }

        .list-footer {
            font-size: 12px;
            color: #9ca3af;
            text-align: left;
            padding-top: 4px;
        }

        #detail-panel {
            display: none;
            max-height: none;
            overflow: visible;
        }

        #detail-panel.visible {
            display: flex;
        }

        .detail-empty {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 300px;
            color: #9ca3af;
            font-size: 14px;
        }

        .detail-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #f3f4f6;
            padding-bottom: 14px;
            margin-bottom: 8px;
        }

        .detail-header .panel-title { margin-bottom: 0; }

        .status-container {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 24px;
        }

        .info-table tr {
            border-bottom: 1px solid #f9fafb;
        }

        .info-table tr:last-child { border-bottom: none; }

        .info-table td {
            padding: 14px 0;
            font-size: 13px;
            vertical-align: middle;
        }

        .info-table td.label {
            font-weight: 600;
            color: #4b5563;
            width: 180px;
        }

        .info-table td.value {
            color: #111827;
            font-weight: 500;
        }

        .action-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 16px;
        }

        .btn-action {
            height: 42px;
            border: none;
            border-radius: 6px;
            font-size: 13.5px;
            font-weight: 700;
            color: #fff;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.15s;
        }

        .btn-action.approve { background: #16a34a; }
        .btn-action.approve:hover { background: #15803d; }
        .btn-action.reject { background: #dc2626; }
        .btn-action.reject:hover { background: #b91c1c; }
        .btn-action svg { width: 16px; height: 16px; }

        .footer {
            text-align: center;
            padding: 16px 28px;
            font-size: 12px;
            color: #9ca3af;
            border-top: 1px solid #e5e7eb;
            background: #fff;
            margin-top: auto;
        }

        @media (max-width: 1024px) {
            .split-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 640px) {
            .content { padding: 16px; }
            .info-table td.label { width: 120px; }
            .action-row { grid-template-columns: 1fr; gap: 10px; }
        }
    </style>
    @endpush

    <main class="content">
        <div class="split-grid">

            <div class="panel-card">
                <div class="panel-title">
                    <span>Senarai Permohonan (Menunggu)</span>
                    <span class="badge-count">5</span>
                </div>

                <div class="search-filter-row">
                    <div class="search-box">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                        <input type="text" placeholder="Cari pemohon / rujukan...">
                    </div>
                    <select class="filter-select">
                        <option>Terdekat</option>
                        <option>Menaik</option>
                        <option>Menurun</option>
                    </select>
                </div>

                <div class="request-list-scroll">
                    <div class="request-list">
                        <div class="request-item selected" onclick="selectRequest(this)">
                            <div class="req-meta">
                                <div class="req-ref-row">
                                    <span class="req-submitted">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        Dihantar: 24 Mei 2024, 08:15 AM
                                    </span>
                                    <span class="badge-status">Menunggu</span>
                                </div>
                                <div class="req-name">Nur Aisyah Binti Ahmad</div>
                                <div class="req-details">
                                    <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg> 24 Mei 2024 (Jumaat)</span>
                                    <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> 09:00 AM - 09:15 AM</span>
                                </div>
                            </div>
                            <div class="chevron-right">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5l7 7-7 7"/></svg>
                            </div>
                        </div>

                        <div class="request-item" onclick="selectRequest(this)">
                            <div class="req-meta">
                                <div class="req-ref-row">
                                    <span class="req-submitted">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        Dihantar: 23 Mei 2024, 10:30 AM
                                    </span>
                                    <span class="badge-status">Menunggu</span>
                                </div>
                                <div class="req-name">Muhammad Faris Bin Razak</div>
                                <div class="req-details">
                                    <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg> 23 Mei 2024 (Khamis)</span>
                                    <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> 02:00 PM - 02:15 PM</span>
                                </div>
                            </div>
                            <div class="chevron-right">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5l7 7-7 7"/></svg>
                            </div>
                        </div>

                        <div class="request-item" onclick="selectRequest(this)">
                            <div class="req-meta">
                                <div class="req-ref-row">
                                    <span class="req-submitted">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        Dihantar: 23 Mei 2024, 02:45 PM
                                    </span>
                                    <span class="badge-status">Menunggu</span>
                                </div>
                                <div class="req-name">Siti Hajar Binti Ismail</div>
                                <div class="req-details">
                                    <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg> 23 Mei 2024 (Khamis)</span>
                                    <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> 04:00 PM - 04:15 PM</span>
                                </div>
                            </div>
                            <div class="chevron-right">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5l7 7-7 7"/></svg>
                            </div>
                        </div>

                        <div class="request-item" onclick="selectRequest(this)">
                            <div class="req-meta">
                                <div class="req-ref-row">
                                    <span class="req-submitted">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        Dihantar: 22 Mei 2024, 11:00 AM
                                    </span>
                                    <span class="badge-status">Menunggu</span>
                                </div>
                                <div class="req-name">Ahmad Danish Bin Nazri</div>
                                <div class="req-details">
                                    <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg> 22 Mei 2024 (Rabu)</span>
                                    <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> 03:00 PM - 03:15 PM</span>
                                </div>
                            </div>
                            <div class="chevron-right">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5l7 7-7 7"/></svg>
                            </div>
                        </div>

                        <div class="request-item" onclick="selectRequest(this)">
                            <div class="req-meta">
                                <div class="req-ref-row">
                                    <span class="req-submitted">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        Dihantar: 21 Mei 2024, 04:30 PM
                                    </span>
                                    <span class="badge-status">Menunggu</span>
                                </div>
                                <div class="req-name">Norsyazwani Binti Zakaria</div>
                                <div class="req-details">
                                    <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg> 22 Mei 2024 (Rabu)</span>
                                    <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> 08:00 AM - 08:15 AM</span>
                                </div>
                            </div>
                            <div class="chevron-right">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5l7 7-7 7"/></svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="list-footer">
                    Memaparkan 1 hingga 5 daripada 5 permohonan
                </div>
            </div>

            <div class="panel-card" id="detail-panel">
                <div class="detail-header">
                    <div class="panel-title">Butiran Permohonan</div>
                    <div class="status-container">
                        Status: <span class="badge-status">Menunggu</span>
                    </div>
                </div>

                <table class="info-table">
                    <tbody>
                        <tr>
                            <td class="label">No. Rujukan</td>
                            <td class="value">DAPUR/2024/05/0012</td>
                        </tr>
                        <tr>
                            <td class="label">Nama Pemohon</td>
                            <td class="value">Nur Aisyah Binti Ahmad</td>
                        </tr>
                        <tr>
                            <td class="label">Tarikh</td>
                            <td class="value">25 Mei 2024 (Sabtu)</td>
                        </tr>
                        <tr>
                            <td class="label">Masa</td>
                            <td class="value">10:05 AM - 10:20 AM (15 minit)</td>
                        </tr>
                        <tr>
                            <td class="label">Dapur</td>
                            <td class="value">Dapur 1</td>
                        </tr>
                        <tr>
                            <td class="label">Lokasi</td>
                            <td class="value">KHAR 4</td>
                        </tr>
                        <tr>
                            <td class="label">Bilangan</td>
                            <td class="value">5 orang</td>
                        </tr>
                    </tbody>
                </table>

                <div class="action-row">
                    <button class="btn-action approve">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        <span>Luluskan</span>
                    </button>
                    <button class="btn-action reject">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                        <span>Tolak</span>
                    </button>
                </div>
            </div>

        </div>
    </main>

    <footer class="footer">
        &copy; 2024 Dapur Siswa Madani UPSI. Hak Cipta Terpelihara.
    </footer>

    <script>
        function selectRequest(el) {
            document.querySelectorAll('.request-item').forEach(item => item.classList.remove('selected'));
            el.classList.add('selected');
            var detail = document.getElementById('detail-panel');
            if (detail) detail.classList.add('visible');
        }

        document.addEventListener('DOMContentLoaded', function () {
            var selected = document.querySelector('.request-item.selected');
            if (selected) {
                document.getElementById('detail-panel').classList.add('visible');
            }
        });
    </script>

</x-admin-layout>
