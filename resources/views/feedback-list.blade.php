<x-admin-layout active="laporan-maklumbalas" title="Maklum Balas Pengguna" subtitle="Senarai maklum balas daripada pengguna sistem.">

    @push('styles')
    <style>
        .content {
            padding: 28px;
            flex: 1;
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

        thead th:last-child { text-align: center; }

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

        tbody td:last-child { text-align: center; }

        tbody td:first-child {
            font-weight: 600;
            color: #1a3a8f;
        }

        .stars {
            display: inline-flex;
            gap: 2px;
        }

        .stars svg {
            width: 15px;
            height: 15px;
        }

        .star-filled { color: #f59e0b; }
        .star-empty { color: #d1d5db; }

        .btn-icon {
            width: 30px;
            height: 30px;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
            background: #fff;
            color: #6b7280;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: background 0.15s, color 0.15s;
        }

        .btn-icon:hover {
            background: #f3f4f6;
            color: #374151;
        }

        .btn-icon svg {
            width: 14px;
            height: 14px;
        }

        .komen-text {
            max-width: 220px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

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

        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 999;
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.show { display: flex; }

        .modal-card {
            background: #fff;
            border-radius: 12px;
            padding: 28px;
            max-width: 480px;
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
            margin-bottom: 20px;
        }

        .modal-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            font-size: 13px;
        }

        .modal-row .mlabel {
            color: #6b7280;
            font-weight: 500;
            min-width: 100px;
        }

        .modal-row .mvalue {
            color: #111827;
            font-weight: 600;
            text-align: right;
        }

        .modal-comment {
            color: #374151;
            font-size: 13px;
            line-height: 1.6;
            background: #f9fafb;
            padding: 12px 14px;
            border-radius: 6px;
        }

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
            float: right;
        }

        .modal-close:hover { background: #e5e7eb; }

        .footer {
            text-align: center;
            padding: 16px 28px;
            font-size: 12px;
            color: #9ca3af;
            border-top: 1px solid #e5e7eb;
            background: #fff;
            margin-top: auto;
        }

        @media (max-width: 640px) {
            .content { padding: 16px; }
            .komen-text { max-width: 120px; }
        }
    </style>
    @endpush

    <main class="content">

        <div class="table-card">
            <div class="table-toolbar">
                <div class="search-wrap">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                    <input type="text" placeholder="Cari nama atau no. matrik...">
                </div>
                <select class="filter-select">
                    <option>Semua Penilaian</option>
                    <option>5 Bintang</option>
                    <option>4 Bintang</option>
                    <option>3 Bintang</option>
                    <option>2 Bintang</option>
                    <option>1 Bintang</option>
                </select>
            </div>

            <table>
                <thead>
                    <tr>
                        <th style="width:50px;">Bil.</th>
                        <th>Nama</th>
                        <th style="width:130px;">No. Matrik</th>
                        <th style="width:130px;">Tarikh</th>
                        <th style="width:130px;">Penilaian</th>
                        <th>Komen</th>
                        <th style="width:70px;">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Nur Aisyah Binti Ahmad</td>
                        <td>D20231098765</td>
                        <td>24/05/2024</td>
                        <td><span class="stars" data-rating="5"></span></td>
                        <td><span class="komen-text">Sangat berpuas hati dengan kemudahan dapur. Bersih dan lengkap!</span></td>
                        <td>
                            <a href="{{ route('laporan.maklumbalas.show', 1) }}" class="btn-icon" title="Lihat">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Muhammad Faris Bin Razak</td>
                        <td>D20221123456</td>
                        <td>23/05/2024</td>
                        <td><span class="stars" data-rating="4"></span></td>
                        <td><span class="komen-text">Peralatan mencukupi, cuma ketuhar perlu diselenggara.</span></td>
                        <td>
                            <button class="btn-icon" title="Lihat" onclick="viewFeedback('Muhammad Faris Bin Razak','D20221123456','23/05/2024','4','Peralatan mencukupi, cuma ketuhar perlu diselenggara.')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Siti Hajar Binti Ismail</td>
                        <td>D20214567890</td>
                        <td>22/05/2024</td>
                        <td><span class="stars" data-rating="5"></span></td>
                        <td><span class="komen-text">Sistem mudah digunakan. Proses tempahan sangat pantas!</span></td>
                        <td>
                            <button class="btn-icon" title="Lihat" onclick="viewFeedback('Siti Hajar Binti Ismail','D20214567890','22/05/2024','5','Sistem mudah digunakan. Proses tempahan sangat pantas!')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Ahmad Danish Bin Nazri</td>
                        <td>D20220987654</td>
                        <td>21/05/2024</td>
                        <td><span class="stars" data-rating="3"></span></td>
                        <td><span class="komen-text">Baik tapi ruang dapur agak sempit untuk kumpulan besar.</span></td>
                        <td>
                            <button class="btn-icon" title="Lihat" onclick="viewFeedback('Ahmad Danish Bin Nazri','D20220987654','21/05/2024','3','Baik tapi ruang dapur agak sempit untuk kumpulan besar.')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Norsyazwani Binti Zakaria</td>
                        <td>D20235678901</td>
                        <td>20/05/2024</td>
                        <td><span class="stars" data-rating="4"></span></td>
                        <td><span class="komen-text">Peti sejuk berfungsi dengan baik. Sangat membantu.</span></td>
                        <td>
                            <button class="btn-icon" title="Lihat" onclick="viewFeedback('Norsyazwani Binti Zakaria','D20235678901','20/05/2024','4','Peti sejuk berfungsi dengan baik. Sangat membantu.')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Amirul Hakim Bin Johari</td>
                        <td>D20211234098</td>
                        <td>19/05/2024</td>
                        <td><span class="stars" data-rating="2"></span></td>
                        <td><span class="komen-text">Kurang berpuas hati. Dapur tidak bersih semasa tiba.</span></td>
                        <td>
                            <button class="btn-icon" title="Lihat" onclick="viewFeedback('Amirul Hakim Bin Johari','D20211234098','19/05/2024','2','Kurang berpuas hati. Dapur tidak bersih semasa tiba.')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Nurul Izzati Binti Kamaruddin</td>
                        <td>D20227890123</td>
                        <td>18/05/2024</td>
                        <td><span class="stars" data-rating="5"></span></td>
                        <td><span class="komen-text">Terbaik! Akan gunakan lagi untuk aktiviti akan datang.</span></td>
                        <td>
                            <button class="btn-icon" title="Lihat" onclick="viewFeedback('Nurul Izzati Binti Kamaruddin','D20227890123','18/05/2024','5','Terbaik! Akan gunakan lagi untuk aktiviti akan datang.')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="pagination">
                <span class="pag-info">Memaparkan 1 hingga 7 daripada 7 maklum balas</span>
                <div class="pag-pages">
                    <button class="pag-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>
                    </button>
                    <button class="pag-btn active">1</button>
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

    <script>
        function renderStars() {
            document.querySelectorAll('.stars').forEach(function(el) {
                var rating = parseInt(el.getAttribute('data-rating')) || 0;
                var html = '';
                for (var i = 1; i <= 5; i++) {
                    if (i <= rating) {
                        html += '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="star-filled"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>';
                    } else {
                        html += '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="star-empty"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>';
                    }
                }
                el.innerHTML = html;
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            renderStars();
        });
    </script>

</x-admin-layout>
