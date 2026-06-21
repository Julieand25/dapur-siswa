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
        }

        #detail-panel.visible {
            display: flex;
            flex-direction: column;
            min-height: 520px;
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

        .detail-content { display: flex; flex-direction: column; flex: 1; }

        .reject-content {
            display: none;
            flex-direction: column;
            flex: 1;
        }

        .reject-content.show {
            display: flex;
        }

        .reject-label {
            font-size: 14px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 4px;
        }

        .reject-hint {
            font-size: 12px;
            color: #9ca3af;
            margin-bottom: 14px;
        }

        .reject-textarea {
            width: 100%;
            min-height: 140px;
            padding: 12px 14px;
            border: 1.5px solid #d1d5db;
            border-radius: 6px;
            font-size: 13px;
            font-family: inherit;
            color: #374151;
            resize: vertical;
            outline: none;
            transition: border-color 0.15s;
            flex: 1;
        }

        .reject-textarea:focus { border-color: #dc2626; }

        .char-count {
            text-align: right;
            font-size: 11px;
            color: #9ca3af;
            margin-top: 6px;
            margin-bottom: 16px;
        }

        .reject-buttons {
            display: flex;
            gap: 12px;
        }

        .btn-reject-back {
            height: 38px;
            padding: 0 22px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            background: #f3f4f6;
            color: #374151;
            border: 1px solid #d1d5db;
            transition: background 0.15s;
        }

        .btn-reject-back:hover { background: #e5e7eb; }

        .btn-reject-submit {
            height: 38px;
            padding: 0 28px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            background: #dc2626;
            color: #fff;
            border: none;
            transition: background 0.15s;
        }

        .btn-reject-submit:hover { background: #b91c1c; }

        .confirm-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 999;
            align-items: center;
            justify-content: center;
        }

        .confirm-overlay.show {
            display: flex;
        }

        .confirm-card {
            background: #fff;
            border-radius: 12px;
            padding: 28px 28px 22px;
            max-width: 440px;
            width: 90%;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            text-align: center;
        }

        .confirm-icon {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #fef3c7;
            color: #d97706;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
        }

        .confirm-icon svg {
            width: 22px;
            height: 22px;
        }

        .confirm-icon.reject-icon {
            background: #fee2e2;
            color: #dc2626;
        }

        .confirm-title {
            font-size: 15px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 8px;
        }

        .confirm-text {
            font-size: 13px;
            color: #6b7280;
            line-height: 1.6;
            margin-bottom: 22px;
        }

        .confirm-buttons {
            display: flex;
            gap: 12px;
            justify-content: center;
        }

        .confirm-btn {
            height: 38px;
            padding: 0 28px;
            border-radius: 6px;
            font-size: 13.5px;
            font-weight: 700;
            cursor: pointer;
            border: none;
            transition: background 0.15s;
        }

        .confirm-btn.no {
            background: #f3f4f6;
            color: #374151;
            border: 1px solid #d1d5db;
        }

        .confirm-btn.no:hover { background: #e5e7eb; }

        .confirm-btn.yes {
            background: #16a34a;
            color: #fff;
        }

        .confirm-btn.yes:hover { background: #15803d; }

        .success-msg {
            background: #dcfce7;
            color: #15803d;
            border: 1px solid #bbf7d0;
            padding: 10px 16px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 20px;
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
        @if (session('success'))
            <div class="success-msg">{{ session('success') }}</div>
        @endif

        <div class="split-grid">

            <div class="panel-card">
                <div class="panel-title">
                    <span>Senarai Permohonan (Menunggu)</span>
                    <span class="badge-count">{{ $pendingBookings->count() }}</span>
                </div>

                <div class="search-filter-row">
                    <div class="search-box">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                        <input type="text" id="searchInput" placeholder="Cari pemohon..." oninput="filterAndRender()">
                    </div>
                    <select class="filter-select" id="sortSelect" onchange="sortAndRender()">
                        <option value="desc">Terdekat</option>
                        <option value="asc">Menaik</option>
                        <option value="desc">Menurun</option>
                    </select>
                </div>

                <div class="request-list-scroll">
                    <div class="request-list" id="requestList"></div>
                </div>

                <div class="list-footer" id="listFooter">
                    @if ($pendingBookings->isEmpty())
                        Tiada permohonan menunggu.
                    @else
                        {{ $pendingBookings->count() }} permohonan menunggu kelulusan
                    @endif
                </div>
            </div>

            <div class="panel-card" id="detail-panel">
                <div class="detail-content" id="detailContent">
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
                            <td class="value" id="val-ref">—</td>
                        </tr>
                        <tr>
                            <td class="label">Nama Pemohon</td>
                            <td class="value" id="val-nama">—</td>
                        </tr>
                        <tr>
                            <td class="label">No. Matrik</td>
                            <td class="value" id="val-matrik">—</td>
                        </tr>
                        <tr>
                            <td class="label">Emel</td>
                            <td class="value" id="val-emel">—</td>
                        </tr>
                        <tr>
                            <td class="label">Tarikh</td>
                            <td class="value" id="val-tarikh">—</td>
                        </tr>
                        <tr>
                            <td class="label">Masa</td>
                            <td class="value" id="val-masa">—</td>
                        </tr>
                        <tr>
                            <td class="label">Dapur</td>
                            <td class="value" id="val-dapur">—</td>
                        </tr>
                        <tr>
                            <td class="label">Lokasi</td>
                            <td class="value" id="val-lokasi">—</td>
                        </tr>
                        <tr>
                            <td class="label">Bilangan</td>
                            <td class="value" id="val-bilangan">—</td>
                        </tr>
                    </tbody>
                </table>

                <div class="action-row">
                    <form id="approveForm" method="POST" action="" style="display:contents;">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="approved">
                        <button type="button" class="btn-action approve" onclick="showConfirm()">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                            <span>Luluskan</span>
                        </button>
                    </form>
                    <form id="rejectForm" method="POST" action="" style="display:contents;">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="rejected">
                        <input type="hidden" name="rejection_reason" id="rejectReasonHidden">
                        <button type="button" class="btn-action reject" onclick="showRejectForm()">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                            <span>Tolak</span>
                        </button>
                    </form>
                </div>
                </div>

                <div class="reject-content" id="rejectContent">
                    <div class="reject-label">Sebab penolakan</div>
                    <div class="reject-hint">Sila nyatakan sebab penolakan ini dengan jelas.</div>
                    <textarea class="reject-textarea" id="rejectReason" placeholder="Taip sebab penolakan di sini..." maxlength="500" oninput="updateCharCount()"></textarea>
                    <div class="char-count"><span id="charCount">0</span>/500</div>
                    <div class="reject-buttons">
                        <button class="btn-reject-back" onclick="hideRejectForm()">Kembali</button>
                        <button class="btn-reject-submit" onclick="submitReject()">Sahkan</button>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <div class="confirm-overlay" id="confirmModal">
        <div class="confirm-card">
            <div class="confirm-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
            </div>
            <div class="confirm-title">Pengesahan Kelulusan</div>
            <div class="confirm-text">
                Adakah anda pasti ingin meluluskan tempahan? Slot untuk masa ini akan diambil dan segala tempahan dengan tarikh dan masa di lokasi dapur yang sama juga akan dibatalkan secara automatik.
            </div>
            <div class="confirm-buttons">
                <button class="confirm-btn no" onclick="closeConfirm()">Tidak</button>
                <button class="confirm-btn yes" onclick="confirmApprove()">Ya</button>
            </div>
        </div>
    </div>

    <div class="confirm-overlay" id="rejectConfirmModal">
        <div class="confirm-card">
            <div class="confirm-icon reject-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </div>
            <div class="confirm-title">Sahkan Penolakan Permohonan</div>
            <div class="confirm-text">
                Anda pasti ingin menolak permohonan ini? Notifikasi akan dihantar terus kepada pemohon.
            </div>
            <div class="confirm-buttons">
                <button class="confirm-btn no" onclick="closeRejectConfirm()">Tidak</button>
                <button class="confirm-btn yes" style="background:#dc2626;" onclick="confirmReject()">Ya</button>
            </div>
        </div>
    </div>

    <footer class="footer">
        &copy; 2024 Dapur Siswa Madani UPSI. Hak Cipta Terpelihara.
    </footer>

    <script>
        var bookingsData = @json($bookingsJson);

        var filteredBookings = bookingsData;
        var selectedIndex = -1;

        function formatTimeRange(start, end) {
            return start + ' - ' + end;
        }

        function calcDuration(start, end) {
            var s = start.split(':');
            var e = end.split(':');
            var mins = (parseInt(e[0]) * 60 + parseInt(e[1])) - (parseInt(s[0]) * 60 + parseInt(s[1]));
            return mins + ' minit';
        }

        function renderList(data) {
            var container = document.getElementById('requestList');
            if (data.length === 0) {
                container.innerHTML = '<div style="padding:20px;text-align:center;color:#9ca3af;font-size:13px;">Tiada permohonan dijumpai.</div>';
                return;
            }
            var html = '';
            data.forEach(function (b, i) {
                var sel = (i === selectedIndex) ? ' selected' : '';
                html += '<div class="request-item' + sel + '" onclick="selectRequest(' + i + ')">';
                html += '<div class="req-meta">';
                html += '<div class="req-ref-row">';
                html += '<span class="req-submitted">';
                html += '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
                html += 'Dihantar: ' + b.created_at;
                html += '</span>';
                html += '<span class="badge-status">Menunggu</span>';
                html += '</div>';
                html += '<div class="req-name">' + escapeHtml(b.nama) + '</div>';
                html += '<div class="req-details">';
                html += '<span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg> ' + b.date_full + '</span>';
                html += '<span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> ' + formatTimeRange(b.start_time, b.end_time) + ' (' + calcDuration(b.start_time, b.end_time) + ')</span>';
                html += '</div>';
                html += '</div>';
                html += '<div class="chevron-right"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5l7 7-7 7"/></svg></div>';
                html += '</div>';
            });
            container.innerHTML = html;
        }

        function selectRequest(index) {
            selectedIndex = index;
            renderList(filteredBookings);

            var b = filteredBookings[index];
            if (!b) return;

            document.getElementById('val-ref').textContent = b.id.substring(0, 8) + '...';
            document.getElementById('val-nama').textContent = b.nama;
            document.getElementById('val-matrik').textContent = b.matrik;
            document.getElementById('val-emel').textContent = b.emel;
            document.getElementById('val-tarikh').textContent = b.date_full;
            document.getElementById('val-masa').textContent = formatTimeRange(b.start_time, b.end_time) + ' (' + calcDuration(b.start_time, b.end_time) + ')';
            document.getElementById('val-dapur').textContent = b.kitchen_name;
            document.getElementById('val-lokasi').textContent = b.location_code;
            document.getElementById('val-bilangan').textContent = b.bilangan_hidangan + ' orang';

            document.getElementById('approveForm').action = b.statusUrl;
            document.getElementById('rejectForm').action = b.statusUrl;

            var panel = document.getElementById('detail-panel');
            if (panel) panel.classList.add('visible');
            syncPanelHeight();
        }

        function sortAndRender() {
            var order = document.getElementById('sortSelect').value;
            filteredBookings.sort(function (a, b) {
                if (order === 'asc') return a.created_at.localeCompare(b.created_at);
                return b.created_at.localeCompare(a.created_at);
            });
            selectedIndex = filteredBookings.length > 0 ? 0 : -1;
            renderList(filteredBookings);
            if (selectedIndex >= 0) selectRequest(selectedIndex);
        }

        function filterAndRender() {
            var q = document.getElementById('searchInput').value.toLowerCase();
            if (q === '') {
                filteredBookings = bookingsData.slice();
            } else {
                filteredBookings = bookingsData.filter(function (b) {
                    return b.nama.toLowerCase().indexOf(q) !== -1
                        || b.matrik.toLowerCase().indexOf(q) !== -1
                        || b.emel.toLowerCase().indexOf(q) !== -1
                        || b.kitchen_name.toLowerCase().indexOf(q) !== -1;
                });
            }
            sortAndRender();
        }

        function escapeHtml(str) {
            var div = document.createElement('div');
            div.textContent = str;
            return div.innerHTML;
        }

        function syncPanelHeight() {
            var leftPanel = document.querySelector('.split-grid .panel-card:first-child');
            var rightPanel = document.getElementById('detail-panel');
            if (rightPanel && rightPanel.classList.contains('visible') && leftPanel) {
                leftPanel.style.maxHeight = rightPanel.offsetHeight + 'px';
            }
        }

        function showConfirm() {
            document.getElementById('confirmModal').classList.add('show');
        }

        function closeConfirm() {
            document.getElementById('confirmModal').classList.remove('show');
        }

        function confirmApprove() {
            closeConfirm();
            document.getElementById('approveForm').submit();
        }

        function showRejectConfirm() {
            document.getElementById('rejectConfirmModal').classList.add('show');
        }

        function closeRejectConfirm() {
            document.getElementById('rejectConfirmModal').classList.remove('show');
        }

        function confirmReject() {
            closeRejectConfirm();
            document.getElementById('rejectReasonHidden').value = document.getElementById('rejectReason').value;
            document.getElementById('rejectForm').submit();
        }

        function showRejectForm() {
            document.getElementById('detailContent').style.display = 'none';
            document.getElementById('rejectContent').classList.add('show');
            syncPanelHeight();
        }

        function hideRejectForm() {
            document.getElementById('rejectContent').classList.remove('show');
            document.getElementById('detailContent').style.display = 'flex';
            document.getElementById('rejectReason').value = '';
            updateCharCount();
            syncPanelHeight();
        }

        function updateCharCount() {
            var len = document.getElementById('rejectReason').value.length;
            document.getElementById('charCount').textContent = len;
        }

        function submitReject() {
            var reason = document.getElementById('rejectReason').value.trim();
            if (!reason) { alert('Sila isi sebab penolakan.'); return; }
            showRejectConfirm();
        }

        document.addEventListener('DOMContentLoaded', function () {
            sortAndRender();
            if (filteredBookings.length > 0) {
                selectRequest(0);
            }
            document.getElementById('detail-panel').classList.add('visible');
            syncPanelHeight();
        });
    </script>

</x-admin-layout>
