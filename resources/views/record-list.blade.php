<x-admin-layout active="laporan-rekod" title="Rekod Peralatan & Barang" subtitle="Rekod penggunaan peralatan dan barang masakan oleh pengguna.">

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
            text-decoration: none;
        }

        .btn-icon:hover {
            background: #f3f4f6;
            color: #374151;
        }

        .btn-icon svg {
            width: 14px;
            height: 14px;
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
        }
    </style>
    @endpush

    <main class="content">

        <div class="table-card">
            <div class="table-toolbar">
                <div class="search-wrap">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                    <input type="text" placeholder="Cari nama, no. matrik, atau emel...">
                </div>
                <select class="filter-select">
                    <option>Semua Lokasi</option>
                    <option>KHAR 4</option>
                    <option>KHAR 3</option>
                    <option>KHAR 2</option>
                </select>
                <select class="filter-select">
                    <option>Semua Dapur</option>
                    <option>Dapur 1</option>
                    <option>Dapur 2</option>
                    <option>Dapur 3</option>
                </select>
            </div>

            <table>
                <thead>
                    <tr>
                        <th style="width:50px;">Bil.</th>
                        <th style="width:110px;">Tarikh Rekod</th>
                        <th>Nama</th>
                        <th style="width:130px;">No. Matrik</th>
                        <th>Emel</th>
                        <th style="width:90px;">Lokasi</th>
                        <th style="width:90px;">Dapur</th>
                        <th style="width:120px;">Jumlah Orang</th>
                        <th style="width:70px;">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>24/05/2024</td>
                        <td>Nur Aisyah Binti Ahmad</td>
                        <td>D20231098765</td>
                        <td>nuraisyah@example.com</td>
                        <td>KHAR 4</td>
                        <td>Dapur 1</td>
                        <td>5</td>
                        <td>
                            <a href="{{ route('laporan.rekod.show', 1) }}" class="btn-icon" title="Lihat">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>23/05/2024</td>
                        <td>Muhammad Faris Bin Razak</td>
                        <td>D20221123456</td>
                        <td>farisfr@example.com</td>
                        <td>KHAR 4</td>
                        <td>Dapur 2</td>
                        <td>3</td>
                        <td>
                            <a href="{{ route('laporan.rekod.show', 2) }}" class="btn-icon" title="Lihat">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>22/05/2024</td>
                        <td>Siti Hajar Binti Ismail</td>
                        <td>D20214567890</td>
                        <td>sitihajar@example.com</td>
                        <td>KHAR 3</td>
                        <td>Dapur 1</td>
                        <td>4</td>
                        <td>
                            <a href="{{ route('laporan.rekod.show', 3) }}" class="btn-icon" title="Lihat">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>21/05/2024</td>
                        <td>Ahmad Danish Bin Nazri</td>
                        <td>D20220987654</td>
                        <td>ahmaddanish@example.com</td>
                        <td>KHAR 3</td>
                        <td>Dapur 2</td>
                        <td>6</td>
                        <td>
                            <a href="{{ route('laporan.rekod.show', 4) }}" class="btn-icon" title="Lihat">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>20/05/2024</td>
                        <td>Norsyazwani Binti Zakaria</td>
                        <td>D20235678901</td>
                        <td>syazwani@example.com</td>
                        <td>KHAR 2</td>
                        <td>Dapur 1</td>
                        <td>2</td>
                        <td>
                            <a href="{{ route('laporan.rekod.show', 5) }}" class="btn-icon" title="Lihat">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>19/05/2024</td>
                        <td>Amirul Hakim Bin Johari</td>
                        <td>D20211234098</td>
                        <td>amirul@example.com</td>
                        <td>KHAR 2</td>
                        <td>Dapur 2</td>
                        <td>8</td>
                        <td>
                            <a href="{{ route('laporan.rekod.show', 6) }}" class="btn-icon" title="Lihat">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="pagination">
                <span class="pag-info">Memaparkan 1 hingga 6 daripada 6 rekod</span>
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

</x-admin-layout>
