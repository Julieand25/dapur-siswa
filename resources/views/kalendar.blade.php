<x-admin-layout active="kalender" title="Kalendar Tempahan" subtitle="Lihat semua tempahan mengikut kalendar bulanan.">

    @push('styles')
    <style>
        .content {
            padding: 28px;
            flex: 1;
        }

        .cal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .cal-nav {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .cal-nav-btn {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            border: 1px solid #d1d5db;
            background: #fff;
            color: #374151;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.15s;
        }

        .cal-nav-btn:hover { background: #f3f4f6; }

        .cal-nav-btn svg {
            width: 14px;
            height: 14px;
        }

        .cal-month {
            font-size: 16px;
            font-weight: 700;
            color: #111827;
            min-width: 130px;
            text-align: center;
        }

        .cal-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .cal-filter {
            padding: 8px 28px 8px 10px;
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

        .cal-card {
            background: #fff;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        .cal-weekdays {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            background: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
        }

        .cal-weekday {
            padding: 10px 8px;
            text-align: center;
            font-size: 11.5px;
            font-weight: 700;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .cal-weekend {
            color: #dc2626;
        }

        .cal-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
        }

        .cal-day {
            min-height: 100px;
            padding: 8px;
            border-right: 1px solid #f3f4f6;
            border-bottom: 1px solid #f3f4f6;
            position: relative;
        }

        .cal-day:nth-child(7n) { border-right: none; }

        .cal-day.other-month {
            background: #fafafa;
        }

        .cal-day.weekend {
            background: #fefafa;
        }

        .cal-day.clickable {
            cursor: pointer;
            transition: background 0.15s;
        }

        .cal-day.clickable:hover {
            background: #f0f7ff;
        }

        .cal-day-num {
            display: block;
            font-size: 12.5px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }

        .cal-day.other-month .cal-day-num { color: #d1d5db; }

        .cal-day.today .cal-day-num {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            background: #1a56db;
            color: #fff;
            border-radius: 50%;
        }

        .cal-slot {
            display: block;
            font-size: 10.5px;
            font-weight: 600;
            padding: 3px 7px;
            border-radius: 4px;
            margin-bottom: 3px;
            cursor: pointer;
            text-decoration: none;
            transition: filter 0.1s;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .cal-slot:hover { filter: brightness(0.92); }

        .cal-slot.lulus {
            background: #ecfdf5;
            color: #059669;
            border: 1px solid #a7f3d0;
        }

        .cal-slot.tunggu {
            background: #fff9db;
            color: #b45309;
            border: 1px solid #fde68a;
        }

        .cal-slot.tolak {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .cal-summary {
            display: block;
            font-size: 10.5px;
            font-weight: 700;
            padding: 3px 7px;
            border-radius: 999px;
            width: fit-content;
        }

        .cal-summary.ada {
            background: #e0e7ff;
            color: #4338ca;
        }

        .cal-summary.penuh {
            background: #fef2f2;
            color: #dc2626;
        }

        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 999;
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.show {
            display: flex;
        }

        #slotModal { z-index: 999; }
        #detailModal { z-index: 1001; }

        .modal-card {
            background: #fff;
            border-radius: 12px;
            padding: 28px;
            max-width: 420px;
            width: 90%;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }

        .modal-title {
            font-size: 15px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .modal-body {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .modal-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
        }

        .modal-row .mlabel {
            color: #6b7280;
            font-weight: 500;
        }

        .modal-row .mvalue {
            color: #111827;
            font-weight: 600;
            text-align: right;
        }

        .modal-badge {
            display: inline-block;
            font-size: 11px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 4px;
        }

        .modal-badge.lulus { background: #ecfdf5; color: #059669; }
        .modal-badge.tunggu { background: #fff9db; color: #b45309; }
        .modal-badge.tolak { background: #fef2f2; color: #dc2626; }

        .modal-close {
            height: 38px;
            padding: 0 28px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            background: #f3f4f6;
            color: #374151;
            border: 1px solid #d1d5db;
            transition: background 0.15s;
            margin-top: 20px;
            float: right;
        }

        .modal-close:hover { background: #e5e7eb; }

        .modal-detail-btns {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }

        .slot-modal {
            max-width: 600px;
            max-height: 85vh;
            display: flex;
            flex-direction: column;
        }

        .slot-modal .modal-body {
            overflow-y: auto;
            flex: 1;
            gap: 0;
            margin-right: -8px;
            padding-right: 8px;
            max-height: 60vh;
        }

        .slot-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid #f3f4f6;
        }

        .slot-header-date {
            font-size: 15px;
            font-weight: 700;
            color: #111827;
        }

        .slot-header-info {
            font-size: 11.5px;
            color: #9ca3af;
            font-weight: 500;
        }

        .slot-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 12px;
            border-radius: 6px;
            margin-bottom: 2px;
            transition: background 0.1s;
        }

        .slot-row:hover {
            background: #f9fafb;
        }

        .slot-time {
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            min-width: 120px;
        }

        .slot-status {
            font-size: 12px;
            font-weight: 600;
        }

        .slot-tersedia {
            color: #9ca3af;
            font-weight: 500;
        }

        .slot-booked {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 3px 10px;
            border-radius: 4px;
            font-size: 11.5px;
            font-weight: 600;
            cursor: pointer;
            transition: filter 0.1s;
        }

        .slot-booked:hover { filter: brightness(0.92); }

        .slot-booked.lulus {
            background: #ecfdf5;
            color: #059669;
            border: 1px solid #a7f3d0;
        }

        .slot-booked.tunggu {
            background: #fff9db;
            color: #b45309;
            border: 1px solid #fde68a;
        }

        .slot-booked.tolak {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .slot-booked svg {
            width: 12px;
            height: 12px;
            flex-shrink: 0;
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

        @media (max-width: 768px) {
            .cal-header { flex-direction: column; align-items: flex-start; }
            .cal-day { min-height: 80px; padding: 5px; }
            .cal-day-num { font-size: 11px; margin-bottom: 3px; }
            .cal-slot { font-size: 9.5px; padding: 2px 5px; }
            .cal-weekday { font-size: 10px; padding: 8px 4px; }
        }

        @media (max-width: 640px) {
            .content { padding: 16px; }
            .slot-time { min-width: 100px; font-size: 12px; }
        }
    </style>
    @endpush

    <main class="content">

        <div class="cal-header">
            <div class="cal-nav">
                <button class="cal-nav-btn" title="Bulan Sebelum" onclick="changeMonth(-1)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>
                </button>
                <span class="cal-month" id="calMonthLabel"></span>
                <button class="cal-nav-btn" title="Bulan Seterusnya" onclick="changeMonth(1)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
                </button>
            </div>

            <div class="cal-actions">
                <select class="cal-filter" id="dapurFilter" onchange="applyFilter()">
                    <option value="">Semua Dapur</option>
                    @foreach ($dapurList as $dapurName)
                        <option value="{{ $dapurName }}">{{ $dapurName }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="cal-card">
            <div class="cal-weekdays">
                <div class="cal-weekday cal-weekend">Ahd</div>
                <div class="cal-weekday">Isn</div>
                <div class="cal-weekday">Sel</div>
                <div class="cal-weekday">Rab</div>
                <div class="cal-weekday">Kha</div>
                <div class="cal-weekday">Jum</div>
                <div class="cal-weekday cal-weekend">Sab</div>
            </div>

            <div class="cal-grid" id="calGrid"></div>
        </div>

    </main>

    <div class="modal-overlay" id="detailModal">
        <div class="modal-card">
            <div class="modal-title" id="dmTitle"></div>
            <div class="modal-body">
                <div class="modal-row"><span class="mlabel">Pemohon</span><span class="mvalue" id="dmPemohon"></span></div>
                <div class="modal-row"><span class="mlabel">No. Matrik</span><span class="mvalue" id="dmMatrik"></span></div>
                <div class="modal-row"><span class="mlabel">Dapur</span><span class="mvalue" id="dmDapur"></span></div>
                <div class="modal-row"><span class="mlabel">Lokasi</span><span class="mvalue" id="dmLokasi"></span></div>
                <div class="modal-row"><span class="mlabel">Masa</span><span class="mvalue" id="dmMasa"></span></div>
                <div class="modal-row"><span class="mlabel">Status</span><span class="mvalue" id="dmStatus"></span></div>
            </div>
            <div class="modal-detail-btns">
                <form id="cancelForm" method="POST" action="" style="display:inline;">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="rejected">
                    <input type="hidden" name="rejection_reason" value="Dibatalkan oleh pentadbir">
                    <button type="submit" class="modal-close" style="background:#dc2626;color:#fff;border-color:#dc2626;">Batalkan Tempahan</button>
                </form>
                <button class="modal-close" onclick="closeDetail()">Tutup</button>
            </div>
        </div>
    </div>

    <div class="modal-overlay" id="slotModal">
        <div class="modal-card slot-modal">
            <div class="slot-header">
                <span class="slot-header-date" id="slotDate"></span>
                <span class="slot-header-info" id="slotTotal"></span>
            </div>
            <div class="modal-body" id="slotList"></div>
            <button class="modal-close" onclick="closeSlotModal()">Tutup</button>
        </div>
    </div>

    <footer class="footer">
        &copy; 2024 Dapur Siswa Madani UPSI. Hak Cipta Terpelihara.
    </footer>

    <script>
        var calendarData = @json($bookingsByDay);
        var currentMonth = {{ $month }};
        var currentYear = {{ $year }};

        var monthNames = ['Januari', 'Februari', 'Mac', 'April', 'Mei', 'Jun', 'Julai', 'Ogos', 'September', 'Oktober', 'November', 'Disember'];

        var currentBooking = null;

        function changeMonth(delta) {
            var m = currentMonth + delta;
            var y = currentYear;
            if (m < 1) { m = 12; y--; }
            if (m > 12) { m = 1; y++; }
            var params = '?month=' + m + '&year=' + y;
            var dapur = document.getElementById('dapurFilter').value;
            if (dapur) params += '&dapur=' + encodeURIComponent(dapur);
            window.location = window.location.pathname + params;
        }

        function applyFilter() {
            var dapur = document.getElementById('dapurFilter').value;
            var params = '?month=' + currentMonth + '&year=' + currentYear;
            if (dapur) params += '&dapur=' + encodeURIComponent(dapur);
            window.location = window.location.pathname + params;
        }

        function getFilteredBookings(day) {
            var items = calendarData[day] || [];
            var dapur = document.getElementById('dapurFilter').value;
            if (!dapur) return items;
            return items.filter(function(b) { return b.kitchen_name === dapur; });
        }

        function countDayBookings(day) {
            return getFilteredBookings(day).length;
        }

        function renderCalendar() {
            var grid = document.getElementById('calGrid');
            var today = new Date();
            var firstDay = new Date(currentYear, currentMonth - 1, 1);
            var startDow = firstDay.getDay();
            var daysInMonth = new Date(currentYear, currentMonth, 0).getDate();
            var prevMonthDays = new Date(currentYear, currentMonth - 1, 0).getDate();

            document.getElementById('calMonthLabel').textContent = monthNames[currentMonth - 1] + ' ' + currentYear;

            var html = '';

            // Previous month days
            for (var i = startDow - 1; i >= 0; i--) {
                var pd = prevMonthDays - i;
                var isWeekend = (i === 5 || i === 6);
                html += '<div class="cal-day other-month' + (isWeekend ? ' weekend' : '') + '"><div class="cal-day-num">' + pd + '</div></div>';
            }

            // Current month days
            for (var d = 1; d <= daysInMonth; d++) {
                var dow = new Date(currentYear, currentMonth - 1, d).getDay();
                var isToday = (d === today.getDate() && currentMonth === (today.getMonth() + 1) && currentYear === today.getFullYear());
                var isWeekend = (dow === 0 || dow === 6);
                var count = countDayBookings(d);

                html += '<div class="cal-day' + (count > 0 ? ' clickable' : '') + (isToday ? ' today' : '') + (isWeekend ? ' weekend' : '') + '"';
                if (count > 0) {
                    html += ' data-day="' + d + '" onclick="openSlotModal(' + d + ')"';
                }
                html += '>';

                html += '<div class="cal-day-num">' + d + '</div>';

                if (count > 0) {
                    if (count >= 22) {
                        html += '<span class="cal-summary penuh">Tempahan Penuh</span>';
                    } else {
                        html += '<span class="cal-summary ada">' + count + ' Tempahan</span>';
                    }
                }

                html += '</div>';
            }

            // Next month days to fill remaining grid cells
            var totalCells = startDow + daysInMonth;
            var remaining = totalCells % 7 === 0 ? 0 : 7 - (totalCells % 7);
            for (var nd = 1; nd <= remaining; nd++) {
                html += '<div class="cal-day other-month"><div class="cal-day-num">' + nd + '</div></div>';
            }

            grid.innerHTML = html;
        }

        function openSlotModal(day) {
            var dayBookings = getFilteredBookings(day);
            var dateObj = new Date(currentYear, currentMonth - 1, day);
            var dateStr = day + ' ' + monthNames[currentMonth - 1] + ' ' + currentYear;
            document.getElementById('slotDate').textContent = dateStr;
            document.getElementById('slotTotal').textContent = dayBookings.length + ' tempahan';

            var html = '';
            dayBookings.forEach(function (b) {
                var sClass = b.status === 'approved' ? 'lulus' : (b.status === 'pending' ? 'tunggu' : 'tolak');
                html += '<div class="slot-row">';
                html += '<span class="slot-time">' + escapeHtml(b.start_time) + ' – ' + escapeHtml(b.end_time) + '</span>';
                html += '<span class="slot-booked ' + sClass + '" onclick="showDetail(' + JSON.stringify(b.id) + ')">';
                html += '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>';
                html += escapeHtml(b.nama);
                html += '</span>';
                html += '</div>';
            });

            document.getElementById('slotList').innerHTML = html;
            document.getElementById('slotModal').classList.add('show');
        }

        function closeSlotModal() {
            document.getElementById('slotModal').classList.remove('show');
        }

        function showDetail(id) {
            var allBookings = [];
            for (var day in calendarData) {
                calendarData[day].forEach(function(b) {
                    if (b.id === id) currentBooking = b;
                });
            }

            if (!currentBooking) return;

            var sClass = currentBooking.status === 'approved' ? 'lulus' : (currentBooking.status === 'pending' ? 'tunggu' : 'tolak');
            var statusLabel = currentBooking.status === 'approved' ? 'Disahkan' : (currentBooking.status === 'pending' ? 'Menunggu' : 'Dibatalkan');

            document.getElementById('dmTitle').innerHTML = 'Butiran Tempahan <span class="modal-badge ' + sClass + '">' + statusLabel + '</span>';
            document.getElementById('dmPemohon').textContent = currentBooking.nama;
            document.getElementById('dmMatrik').textContent = currentBooking.matrik;
            document.getElementById('dmDapur').textContent = currentBooking.kitchen_name;
            document.getElementById('dmLokasi').textContent = currentBooking.location_code;
            document.getElementById('dmMasa').textContent = currentBooking.start_time + ' – ' + currentBooking.end_time;
            document.getElementById('dmStatus').innerHTML = '<span class="modal-badge ' + sClass + '">' + statusLabel + '</span>';

            document.getElementById('cancelForm').action = currentBooking.statusUrl;

            var cancelBtn = document.querySelector('#detailModal .modal-detail-btns form');
            if (cancelBtn && currentBooking.status === 'rejected') {
                cancelBtn.style.display = 'none';
            } else if (cancelBtn) {
                cancelBtn.style.display = 'inline';
            }

            document.getElementById('detailModal').classList.add('show');
        }

        function closeDetail() {
            document.getElementById('detailModal').classList.remove('show');
            currentBooking = null;
        }

        function escapeHtml(str) {
            var div = document.createElement('div');
            div.textContent = str;
            return div.innerHTML;
        }

        document.getElementById('detailModal').addEventListener('click', function(e) {
            if (e.target === this) closeDetail();
        });

        document.getElementById('slotModal').addEventListener('click', function(e) {
            if (e.target === this) closeSlotModal();
        });

        document.addEventListener('DOMContentLoaded', function () {
            renderCalendar();
        });
    </script>

</x-admin-layout>
