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

        .btn-filter {
            background: #fff;
            border: 1.5px solid #d1d5db;
            border-radius: 6px;
            padding: 0 12px;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12.5px;
            font-weight: 600;
            color: #374151;
            cursor: pointer;
        }

        .btn-filter svg { width: 14px; height: 14px; }

        .request-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 16px;
        }

        .request-item {
            border: 1.5px solid #e5e7eb;
            border-radius: 8px;
            padding: 14px 16px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.15s;
            text-decoration: none;
            color: inherit;
        }

        .request-item:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
        }

        .request-item.selected {
            background: #fffdf5;
            border-color: #fcd34d;
            box-shadow: 0 0 0 1px #fcd34d;
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

        .req-ref {
            font-size: 12px;
            font-weight: 700;
            color: #111827;
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

        .info-alert {
            background: #f0f7ff;
            border: 1px solid #e0f2fe;
            border-radius: 6px;
            padding: 12px 14px;
            display: flex;
            align-items: flex-start;
            gap: 8px;
            font-size: 11.5px;
            color: #0369a1;
            font-weight: 500;
            line-height: 1.4;
        }

        .info-alert svg {
            width: 15px; height: 15px;
            color: #38bdf8;
            flex-shrink: 0;
            margin-top: 1px;
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
                    <button class="btn-filter">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                        <span>Tapis</span>
                    </button>
                </div>

                <div class="request-list">
                    <a href="#" class="request-item selected">
                        <div class="req-meta">
                            <div class="req-ref-row">
                                <span class="req-ref">REF: DAPUR/2024/05/0012</span>
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
                    </a>

                    <a href="#" class="request-item">
                        <div class="req-meta">
                            <div class="req-ref-row">
                                <span class="req-ref">REF: DAPUR/2024/05/0011</span>
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
                    </a>

                    <a href="#" class="request-item">
                        <div class="req-meta">
                            <div class="req-ref-row">
                                <span class="req-ref">REF: DAPUR/2024/05/0010</span>
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
                    </a>

                    <a href="#" class="request-item">
                        <div class="req-meta">
                            <div class="req-ref-row">
                                <span class="req-ref">REF: DAPUR/2024/05/0009</span>
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
                    </a>

                    <a href="#" class="request-item">
                        <div class="req-meta">
                            <div class="req-ref-row">
                                <span class="req-ref">REF: DAPUR/2024/05/0008</span>
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
                    </a>
                </div>

                <div class="list-footer">
                    Memaparkan 1 hingga 5 daripada 5 permohonan
                </div>
            </div>

            <div class="panel-card">
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

                <div class="info-alert">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span>Sila semak maklumat permohonan sebelum membuat keputusan kelulusan.</span>
                </div>
            </div>

        </div>
    </main>

    <footer class="footer">
        &copy; 2024 Dapur Siswa Madani UPSI. Hak Cipta Terpelihara.
    </footer>

</x-admin-layout>
