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
                <button class="cal-nav-btn" title="Bulan Sebelum">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>
                </button>
                <span class="cal-month">Mei 2024</span>
                <button class="cal-nav-btn" title="Bulan Seterusnya">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
                </button>
            </div>

            <div class="cal-actions">
                <select class="cal-filter">
                    <option>Semua Dapur</option>
                    <option>Dapur 1</option>
                    <option>Dapur 2</option>
                    <option>Dapur 3</option>
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

            <div class="cal-grid">
                <div class="cal-day weekend other-month"><div class="cal-day-num">28</div></div>
                <div class="cal-day other-month"><div class="cal-day-num">29</div></div>
                <div class="cal-day other-month"><div class="cal-day-num">30</div></div>

                <div class="cal-day clickable" data-day="1" onclick="openSlotModal(1)"><div class="cal-day-num">1</div></div>
                <div class="cal-day clickable" data-day="2" onclick="openSlotModal(2)"><div class="cal-day-num">2</div></div>
                <div class="cal-day clickable" data-day="3" onclick="openSlotModal(3)"><div class="cal-day-num">3</div></div>
                <div class="cal-day weekend"><div class="cal-day-num">4</div></div>
                <div class="cal-day weekend"><div class="cal-day-num">5</div></div>
                <div class="cal-day clickable" data-day="6" onclick="openSlotModal(6)"><div class="cal-day-num">6</div></div>
                <div class="cal-day clickable today" data-day="7" onclick="openSlotModal(7)"><div class="cal-day-num">7</div></div>
                <div class="cal-day clickable" data-day="8" onclick="openSlotModal(8)"><div class="cal-day-num">8</div></div>
                <div class="cal-day clickable" data-day="9" onclick="openSlotModal(9)"><div class="cal-day-num">9</div></div>
                <div class="cal-day clickable" data-day="10" onclick="openSlotModal(10)"><div class="cal-day-num">10</div></div>
                <div class="cal-day weekend"><div class="cal-day-num">11</div></div>
                <div class="cal-day weekend"><div class="cal-day-num">12</div></div>
                <div class="cal-day clickable" data-day="13" onclick="openSlotModal(13)"><div class="cal-day-num">13</div></div>
                <div class="cal-day clickable" data-day="14" onclick="openSlotModal(14)"><div class="cal-day-num">14</div></div>
                <div class="cal-day clickable" data-day="15" onclick="openSlotModal(15)"><div class="cal-day-num">15</div></div>
                <div class="cal-day clickable" data-day="16" onclick="openSlotModal(16)"><div class="cal-day-num">16</div></div>
                <div class="cal-day clickable" data-day="17" onclick="openSlotModal(17)"><div class="cal-day-num">17</div></div>
                <div class="cal-day weekend"><div class="cal-day-num">18</div></div>
                <div class="cal-day weekend"><div class="cal-day-num">19</div></div>
                <div class="cal-day clickable" data-day="20" onclick="openSlotModal(20)"><div class="cal-day-num">20</div></div>
                <div class="cal-day clickable" data-day="21" onclick="openSlotModal(21)"><div class="cal-day-num">21</div></div>
                <div class="cal-day clickable" data-day="22" onclick="openSlotModal(22)"><div class="cal-day-num">22</div></div>
                <div class="cal-day clickable" data-day="23" onclick="openSlotModal(23)"><div class="cal-day-num">23</div></div>
                <div class="cal-day clickable" data-day="24" onclick="openSlotModal(24)"><div class="cal-day-num">24</div></div>
                <div class="cal-day weekend"><div class="cal-day-num">25</div></div>
                <div class="cal-day weekend"><div class="cal-day-num">26</div></div>
                <div class="cal-day clickable" data-day="27" onclick="openSlotModal(27)"><div class="cal-day-num">27</div></div>
                <div class="cal-day clickable" data-day="28" onclick="openSlotModal(28)"><div class="cal-day-num">28</div></div>
                <div class="cal-day clickable" data-day="29" onclick="openSlotModal(29)"><div class="cal-day-num">29</div></div>
                <div class="cal-day clickable" data-day="30" onclick="openSlotModal(30)"><div class="cal-day-num">30</div></div>
                <div class="cal-day clickable" data-day="31" onclick="openSlotModal(31)"><div class="cal-day-num">31</div></div>
            </div>
        </div>

    </main>

    <div class="modal-overlay" id="detailModal">
        <div class="modal-card">
            <div class="modal-title" id="dmTitle"></div>
            <div class="modal-body">
                <div class="modal-row"><span class="mlabel">Pemohon</span><span class="mvalue" id="dmPemohon"></span></div>
                <div class="modal-row"><span class="mlabel">Dapur</span><span class="mvalue" id="dmDapur"></span></div>
                <div class="modal-row"><span class="mlabel">Lokasi</span><span class="mvalue" id="dmLokasi"></span></div>
                <div class="modal-row"><span class="mlabel">Masa</span><span class="mvalue" id="dmMasa"></span></div>
                <div class="modal-row"><span class="mlabel">Status</span><span class="mvalue" id="dmStatus"></span></div>
            </div>
            <div class="modal-detail-btns">
                <button class="modal-close" onclick="cancelBooking()" style="background:#dc2626;color:#fff;border-color:#dc2626;">Batalkan Tempahan</button>
                <button class="modal-close" onclick="closeDetail()">Tutup</button>
            </div>
        </div>
    </div>

    <div class="modal-overlay" id="slotModal">
        <div class="modal-card slot-modal">
            <div class="slot-header">
                <span class="slot-header-date" id="slotDate">1 Mei 2024</span>
                <span class="slot-header-info" id="slotTotal">22 slot masa</span>
            </div>
            <div class="modal-body" id="slotList"></div>
            <button class="modal-close" onclick="closeSlotModal()">Tutup</button>
        </div>
    </div>

    <footer class="footer">
        &copy; 2024 Dapur Siswa Madani UPSI. Hak Cipta Terpelihara.
    </footer>

    <script>
        var bookings = {
            1: [
                {name:'Nur Aisyah',dapur:'Dapur 1',lokasi:'KHAR 4',masa:'09:00-09:15',status:'Menunggu',slot:4},
                {name:'Hafizul Hakim',dapur:'Dapur 2',lokasi:'KHAR 4',masa:'14:00-14:15',status:'Diluluskan',slot:15}
            ],
            2: [
                {name:'Amirul Hakim',dapur:'Dapur 3',lokasi:'KHAR 3',masa:'10:00-10:15',status:'Diluluskan',slot:6}
            ],
            3: [
                {name:'Siti Hajar',dapur:'Dapur 1',lokasi:'KHAR 4',masa:'08:00-08:15',status:'Diluluskan',slot:0},
                {name:'Farhana',dapur:'Dapur 2',lokasi:'KHAR 3',masa:'11:00-11:15',status:'Menunggu',slot:8},
                {name:'Akmal',dapur:'Dapur 1',lokasi:'KHAR 4',masa:'16:00-16:15',status:'Diluluskan',slot:20}
            ],
            6: [
                {name:'M. Faris',dapur:'Dapur 1',lokasi:'KHAR 4',masa:'09:30-09:45',status:'Menunggu',slot:5}
            ],
            7: [
                {name:'Nur Aisyah',dapur:'Dapur 1',lokasi:'KHAR 4',masa:'08:30-08:45',status:'Diluluskan',slot:2},
                {name:'A. Danish',dapur:'Dapur 2',lokasi:'KHAR 3',masa:'12:00-12:15',status:'Menunggu',slot:10}
            ],
            9: [
                {name:'Nur Aisyah',dapur:'Dapur 3',lokasi:'KHAR 2',masa:'07:00-07:15',status:'Menunggu',slot:-1}
            ],
            10: [
                {name:'Syazwani',dapur:'Dapur 1',lokasi:'KHAR 4',masa:'15:00-15:15',status:'Diluluskan',slot:17}
            ],
            13: [
                {name:'Hafizul',dapur:'Dapur 1',lokasi:'KHAR 4',masa:'10:00-10:15',status:'Diluluskan',slot:6},
                {name:'Amirul H.',dapur:'Dapur 3',lokasi:'KHAR 3',masa:'13:00-13:15',status:'Diluluskan',slot:13}
            ],
            14: [
                {name:'Nur Aisyah',dapur:'Dapur 2',lokasi:'KHAR 3',masa:'16:00-16:15',status:'Ditolak',slot:20}
            ],
            20: [
                {name:'Siti Hajar',dapur:'Dapur 1',lokasi:'KHAR 4',masa:'11:00-11:15',status:'Menunggu',slot:8}
            ]
        };

        function generateSlots() {
            var slots = [];
            var h = 8, m = 0;
            for (var i = 0; i < 22; i++) {
                var start = pad(h) + ':' + pad(m);
                var endH = h, endM = m + 15;
                if (endM >= 60) { endH++; endM -= 60; }
                var end = pad(endH) + ':' + pad(endM);
                slots.push({time: start + ' - ' + end});
                m += 25;
                if (m >= 60) { h++; m -= 60; }
            }
            return slots;
        }

        function pad(n) { return n < 10 ? '0' + n : '' + n; }

        var allSlots = generateSlots();

        function openSlotModal(day) {
            var dayBookings = bookings[day] || [];
            var dateStr = day + ' Mei 2024';
            document.getElementById('slotDate').textContent = dateStr;

            var bookedCount = dayBookings.filter(function(b) { return b.slot >= 0 && b.slot < 22; }).length;
            document.getElementById('slotTotal').textContent = bookedCount + ' ditempah &middot; ' + (22 - bookedCount) + ' tersedia';

            var html = '';
            for (var i = 0; i < allSlots.length; i++) {
                var found = null;
                for (var j = 0; j < dayBookings.length; j++) {
                    if (dayBookings[j].slot === i) { found = dayBookings[j]; break; }
                }
                html += '<div class="slot-row">';
                html += '<span class="slot-time">' + allSlots[i].time + '</span>';
                if (found) {
                    var sClass = found.status === 'Diluluskan' ? 'lulus' : (found.status === 'Menunggu' ? 'tunggu' : 'tolak');
                    html += '<span class="slot-booked ' + sClass + '" onclick="showDetail(\'' + found.name + '\',\'' + found.dapur + '\',\'' + found.lokasi + '\',\'' + found.masa + '\',\'' + found.status + '\')">';
                    html += '<svg xmlns=\'http://www.w3.org/2000/svg\' fill=\'none\' viewBox=\'0 0 24 24\' stroke=\'currentColor\' stroke-width=\'2\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' d=\'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z\'/></svg>';
                    html += found.name + '</span>';
                } else {
                    html += '<span class="slot-status slot-tersedia">Tersedia</span>';
                }
                html += '</div>';
            }
            document.getElementById('slotList').innerHTML = html;
            document.getElementById('slotModal').classList.add('show');
        }

        function closeSlotModal() {
            document.getElementById('slotModal').classList.remove('show');
        }

        var currentBooking = null;

        function showDetail(pemohon, dapur, lokasi, masa, status) {
            currentBooking = {pemohon:pemohon, dapur:dapur, lokasi:lokasi, masa:masa, status:status};
            var sClass = status === 'Diluluskan' ? 'lulus' : (status === 'Menunggu' ? 'tunggu' : 'tolak');
            document.getElementById('dmTitle').innerHTML = 'Butiran Tempahan <span class="modal-badge ' + sClass + '">' + status + '</span>';
            document.getElementById('dmPemohon').textContent = pemohon;
            document.getElementById('dmDapur').textContent = dapur;
            document.getElementById('dmLokasi').textContent = lokasi;
            document.getElementById('dmMasa').textContent = masa;
            document.getElementById('dmStatus').innerHTML = '<span class="modal-badge ' + sClass + '">' + status + '</span>';
            document.getElementById('detailModal').classList.add('show');
        }

        function closeDetail() {
            document.getElementById('detailModal').classList.remove('show');
        }

        function cancelBooking() {
            if (currentBooking && currentBooking.status !== 'Ditolak') {
                currentBooking.status = 'Ditolak';
                var sClass = 'tolak';
                document.getElementById('dmTitle').innerHTML = 'Butiran Tempahan <span class="modal-badge ' + sClass + '">Ditolak</span>';
                document.getElementById('dmStatus').innerHTML = '<span class="modal-badge ' + sClass + '">Ditolak</span>';
                var cancelBtn = document.querySelector('#detailModal .modal-close:first-child');
                if (cancelBtn) cancelBtn.style.display = 'none';
            }
        }

        document.getElementById('detailModal').addEventListener('click', function(e) {
            if (e.target === this) closeDetail();
        });

        document.getElementById('slotModal').addEventListener('click', function(e) {
            if (e.target === this) closeSlotModal();
        });

        document.addEventListener('DOMContentLoaded', function() {
            var days = document.querySelectorAll('.cal-day[data-day]');
            days.forEach(function(day) {
                var d = parseInt(day.getAttribute('data-day'));
                var count = 0;
                if (bookings[d]) {
                    bookings[d].forEach(function(b) {
                        if (b.slot >= 0 && b.slot < 22) count++;
                    });
                }
                if (count > 0) {
                    var badge = document.createElement('span');
                    if (count >= 22) {
                        badge.className = 'cal-summary penuh';
                        badge.textContent = 'Tempahan Penuh';
                    } else {
                        badge.className = 'cal-summary ada';
                        badge.textContent = count + ' Tempahan';
                    }
                    var dayNum = day.querySelector('.cal-day-num');
                    if (dayNum) {
                        dayNum.insertAdjacentElement('afterend', badge);
                    } else {
                        day.appendChild(badge);
                    }
                }
            });
        });
    </script>

</x-admin-layout>
