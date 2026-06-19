<x-admin-layout active="laporan-rekod" title="Butiran Rekod" subtitle="Maklumat lengkap penggunaan peralatan dan bahan masakan.">

    @push('styles')
    <style>
        .content {
            padding: 28px;
            flex: 1;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 600;
            color: #6b7280;
            text-decoration: none;
            margin-bottom: 20px;
            transition: color 0.15s;
        }

        .back-link:hover { color: #374151; }

        .back-link svg {
            width: 15px;
            height: 15px;
        }

        .detail-card {
            background: #fff;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            padding: 28px;
            margin-bottom: 20px;
        }

        .detail-title {
            font-size: 14.5px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid #f3f4f6;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
        }

        .info-row {
            display: flex;
            padding: 10px 0;
            border-bottom: 1px solid #f9fafb;
        }

        .info-row .ilabel {
            font-size: 13px;
            font-weight: 600;
            color: #6b7280;
            width: 150px;
            flex-shrink: 0;
        }

        .info-row .ivalue {
            font-size: 13px;
            font-weight: 500;
            color: #111827;
        }

        .table-section {
            margin-top: 24px;
        }

        .table-section-title {
            font-size: 13.5px;
            font-weight: 700;
            color: #374151;
            margin-bottom: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            overflow: hidden;
        }

        thead tr {
            background: #f9fafb;
        }

        thead th {
            padding: 10px 14px;
            text-align: left;
            font-size: 11.5px;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        tbody tr {
            border-top: 1px solid #f3f4f6;
        }

        tbody td {
            padding: 10px 14px;
            color: #374151;
            vertical-align: middle;
        }

        .badge-status {
            display: inline-block;
            font-size: 11px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 4px;
        }

        .badge-baik { background: #ecfdf5; color: #059669; }
        .badge-rosak { background: #fef2f2; color: #dc2626; }

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
            .detail-card { padding: 20px; }
            .info-grid { grid-template-columns: 1fr; }
            .info-row .ilabel { width: 120px; }
        }
    </style>
    @endpush

    <main class="content">
        <a href="{{ route('laporan.rekod') }}" class="back-link">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Rekod Peralatan & Barang
        </a>

        <div class="detail-card">
            <div class="detail-title">Maklumat Pengguna</div>
            <div class="info-grid">
                <div class="info-row"><span class="ilabel">Nama</span><span class="ivalue">Nur Aisyah Binti Ahmad</span></div>
                <div class="info-row"><span class="ilabel">No. Matrik</span><span class="ivalue">D20231098765</span></div>
                <div class="info-row"><span class="ilabel">Emel</span><span class="ivalue">nuraisyah@example.com</span></div>
                <div class="info-row"><span class="ilabel">Tarikh Rekod</span><span class="ivalue">24 Mei 2024</span></div>
                <div class="info-row"><span class="ilabel">Lokasi</span><span class="ivalue">KHAR 4</span></div>
                <div class="info-row"><span class="ilabel">Dapur</span><span class="ivalue">Dapur 1</span></div>
                <div class="info-row"><span class="ilabel">Jumlah Orang</span><span class="ivalue">5 orang</span></div>
            </div>
        </div>

        <div class="detail-card">
            <div class="detail-title">Peralatan Digunakan</div>
            <div class="table-section">
                <table>
                    <thead>
                        <tr>
                            <th style="width:50px;">Bil.</th>
                            <th>Peralatan</th>
                            <th style="width:100px;">Kuantiti</th>
                            <th style="width:120px;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Periuk Besar</td>
                            <td>2</td>
                            <td><span class="badge-status badge-baik">Baik</span></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Kuali Leper</td>
                            <td>1</td>
                            <td><span class="badge-status badge-baik">Baik</span></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Pisau Chef</td>
                            <td>3</td>
                            <td><span class="badge-status badge-baik">Baik</span></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Papan Pemotong</td>
                            <td>2</td>
                            <td><span class="badge-status badge-rosak">Rosak</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="detail-card">
            <div class="detail-title">Bahan Masak Digunakan</div>
            <div class="table-section">
                <table>
                    <thead>
                        <tr>
                            <th style="width:50px;">Bil.</th>
                            <th>Bahan</th>
                            <th style="width:100px;">Kuantiti</th>
                            <th style="width:100px;">Unit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Minyak Masak</td>
                            <td>1</td>
                            <td>Botol</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Beras</td>
                            <td>2</td>
                            <td>Kg</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Garam</td>
                            <td>1</td>
                            <td>Pek</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Gula Pasir</td>
                            <td>0.5</td>
                            <td>Kg</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <footer class="footer">
        &copy; 2024 Dapur Siswa Madani UPSI. Hak Cipta Terpelihara.
    </footer>

</x-admin-layout>
