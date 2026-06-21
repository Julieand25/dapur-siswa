<x-admin-layout active="dapur" title="Senarai Dapur" subtitle="Urus dan pantau semua dapur yang berdaftar dalam sistem.">

    @push('styles')
    <style>
        .content {
            padding: 28px;
            flex: 1;
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
            margin-bottom: 16px;
        }

        .btn-tambah:hover { background: #1e40af; }

        .btn-tambah svg {
            width: 16px;
            height: 16px;
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

        .col-bil {
            text-align: center;
            width: 50px;
            color: #9ca3af;
            font-weight: 600;
        }

        .col-dapur {
            font-weight: 600;
            color: #111827;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 100px;
            padding: 1px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 700;
            border: 1px solid;
        }

        .badge-tersedia  { background: #dcfce7; color: #15803d; border-color: #bbf7d0; }
        .badge-tidak-tersedia { background: #fee2e2; color: #b91c1c; border-color: #fecaca; }

        .action-links {
            display: flex;
            gap: 16px;
        }

        .action-links a {
            font-size: 13px;
            font-weight: 600;
            color: #1a56db;
            text-decoration: none;
        }

        .action-links a:hover {
            text-decoration: underline;
            color: #1e40af;
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
            .table-toolbar { flex-direction: column; }
            .search-wrap { max-width: 100%; }
            .action-links { flex-direction: column; gap: 6px; }
        }

        @media (max-width: 640px) {
            .content { padding: 16px; }
        }
    </style>
    @endpush

    <main class="content">

        <a href="{{ route('dapur.create') }}" class="btn-tambah">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Tambah Dapur
        </a>

        <div class="table-card">

            <div class="table-toolbar">
                <div class="search-wrap">
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
            </div>

            <table>
                <thead>
                    <tr>
                        <th class="col-bil">Bil.</th>
                        <th>Lokasi</th>
                        <th>Dapur</th>
                        <th>Status</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col-bil">1</td>
                        <td>KHAR 4</td>
                        <td class="col-dapur">Dapur 1</td>
                        <td><span class="badge badge-tersedia">Tersedia</span></td>
                        <td>
                            <div class="action-links">
                                <a href="{{ route('dapur.edit', 1) }}">Ubah Dapur</a>
                                <a href="{{ route('dapur.barang', 1) }}">Urus Barang</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-bil">2</td>
                        <td>KHAR 4</td>
                        <td class="col-dapur">Dapur 2</td>
                        <td><span class="badge badge-tersedia">Tersedia</span></td>
                        <td>
                            <div class="action-links">
                                <a href="{{ route('dapur.edit', 2) }}">Ubah Dapur</a>
                                <a href="{{ route('dapur.barang', 2) }}">Urus Barang</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-bil">3</td>
                        <td>KHAR 3</td>
                        <td class="col-dapur">Dapur 1</td>
                        <td><span class="badge badge-tidak-tersedia">Tidak Tersedia</span></td>
                        <td>
                            <div class="action-links">
                                <a href="{{ route('dapur.edit', 3) }}">Ubah Dapur</a>
                                <a href="{{ route('dapur.barang', 3) }}">Urus Barang</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-bil">4</td>
                        <td>KHAR 3</td>
                        <td class="col-dapur">Dapur 2</td>
                        <td><span class="badge badge-tersedia">Tersedia</span></td>
                        <td>
                            <div class="action-links">
                                <a href="{{ route('dapur.edit', 4) }}">Ubah Dapur</a>
                                <a href="{{ route('dapur.barang', 4) }}">Urus Barang</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-bil">5</td>
                        <td>KHAR 2</td>
                        <td class="col-dapur">Dapur 1</td>
                        <td><span class="badge badge-tersedia">Tersedia</span></td>
                        <td>
                            <div class="action-links">
                                <a href="{{ route('dapur.edit', 5) }}">Ubah Dapur</a>
                                <a href="{{ route('dapur.barang', 5) }}">Urus Barang</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-bil">6</td>
                        <td>KHAR 2</td>
                        <td class="col-dapur">Dapur 2</td>
                        <td><span class="badge badge-tidak-tersedia">Tidak Tersedia</span></td>
                        <td>
                            <div class="action-links">
                                <a href="{{ route('dapur.edit', 6) }}">Ubah Dapur</a>
                                <a href="{{ route('dapur.barang', 6) }}">Urus Barang</a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>

    <footer class="footer">
        &copy; 2024 Dapur Siswa Madani UPSI. Hak Cipta Terpelihara.
    </footer>

</x-admin-layout>
