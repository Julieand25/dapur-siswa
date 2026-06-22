<x-admin-layout active="pengguna" title="Senarai Pengguna" subtitle="Semua pengguna berdaftar dalam sistem.">

    @push('styles')
    <style>
        .content {
            padding: 28px;
            flex: 1;
        }

        .stat-grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 16px;
            margin-bottom: 24px;
            max-width: 260px;
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

        .stat-icon.blue { background: #1a56db; color: #fff; }

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
            max-width: 340px;
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
        }

        .btn-icon:hover {
            background: #f3f4f6;
            color: #374151;
        }

        .btn-icon svg {
            width: 14px;
            height: 14px;
        }

        .empty-msg {
            text-align: center;
            padding: 40px 20px;
            color: #9ca3af;
            font-size: 13px;
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
            text-decoration: none;
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

        .modal-overlay.show {
            display: flex;
        }

        .modal-card {
            background: #fff;
            border-radius: 12px;
            padding: 28px;
            max-width: 440px;
            width: 90%;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }

        .modal-title {
            font-size: 15px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 20px;
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
            max-width: 260px;
            word-break: break-word;
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
            margin-top: 20px;
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
            .stat-grid { max-width: 100%; }
        }
    </style>
    @endpush

    <main class="content">

        <div class="stat-grid">
            <div class="stat-card">
                <div class="stat-icon blue">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
                </div>
                <div class="stat-body">
                    <div class="stat-num">{{ $users->total() }}</div>
                    <div class="stat-label">Jumlah Pengguna</div>
                </div>
            </div>
        </div>

        <div class="table-card">

            <form class="table-toolbar" method="GET" action="{{ route('pengguna.index') }}">
                <div class="search-wrap">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                    <input type="text" name="search" placeholder="Cari nama, no. matrik, atau emel..." value="{{ request('search') }}">
                </div>
            </form>

            @if ($users->isEmpty())
                <div class="empty-msg">Tiada pengguna dijumpai.</div>
            @else
                <table>
                    <thead>
                        <tr>
                            <th style="width:50px;">Bil.</th>
                            <th>Nama Pengguna</th>
                            <th style="width:130px;">No. Matrik</th>
                            <th style="width:180px;">Fakulti / Jabatan</th>
                            <th>Emel</th>
                            <th style="width:120px;">Tarikh Daftar</th>
                            <th style="width:70px;">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $u)
                            <tr>
                                <td>{{ $loop->iteration + (($users->currentPage() - 1) * $users->perPage()) }}</td>
                                <td>{{ $u->name ?? '—' }}</td>
                                <td>{{ $u->matrik ?? '—' }}</td>
                                <td>{{ $u->faculty ?? '—' }}</td>
                                <td>{{ $u->email }}</td>
                                <td>{{ \Carbon\Carbon::parse($u->created_at)->timezone('Asia/Kuala_Lumpur')->format('d/m/Y') }}</td>
                                <td>
                                    <button class="btn-icon" title="Lihat"
                                        onclick="showDetail(this)"
                                        data-name="{{ $u->name ?? '—' }}"
                                        data-matrik="{{ $u->matrik ?? '—' }}"
                                        data-email="{{ $u->email }}"
                                        data-faculty="{{ $u->faculty ?? '—' }}"
                                        data-program="{{ $u->program ?? '—' }}"
                                        data-phone="{{ $u->phone ?? '—' }}"
                                        data-created="{{ \Carbon\Carbon::parse($u->created_at)->timezone('Asia/Kuala_Lumpur')->format('d/m/Y h:i A') }}"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if ($users->hasPages())
                    <div class="pagination">
                        <span class="pag-info">Memaparkan {{ $users->firstItem() }} hingga {{ $users->lastItem() }} daripada {{ $users->total() }} rekod</span>
                        <div class="pag-pages">
                            @if (! $users->onFirstPage())
                                <a href="{{ $users->previousPageUrl() }}" class="pag-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>
                                </a>
                            @endif

                            @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                                <a href="{{ $url }}" class="pag-btn {{ $page == $users->currentPage() ? 'active' : '' }}">{{ $page }}</a>
                            @endforeach

                            @if ($users->hasMorePages())
                                <a href="{{ $users->nextPageUrl() }}" class="pag-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            @endif
        </div>

    </main>

    <div class="modal-overlay" id="userModal">
        <div class="modal-card">
            <div class="modal-title">Butiran Pengguna</div>
            <div class="modal-body">
                <div class="modal-row"><span class="mlabel">Nama</span><span class="mvalue" id="dmNama"></span></div>
                <div class="modal-row"><span class="mlabel">No. Matrik</span><span class="mvalue" id="dmMatrik"></span></div>
                <div class="modal-row"><span class="mlabel">Emel</span><span class="mvalue" id="dmEmel"></span></div>
                <div class="modal-row"><span class="mlabel">Fakulti</span><span class="mvalue" id="dmFakulti"></span></div>
                <div class="modal-row"><span class="mlabel">Program</span><span class="mvalue" id="dmProgram"></span></div>
                <div class="modal-row"><span class="mlabel">No. Telefon</span><span class="mvalue" id="dmTelefon"></span></div>
                <div class="modal-row"><span class="mlabel">Tarikh Daftar</span><span class="mvalue" id="dmTarikh"></span></div>
            </div>
            <button class="modal-close" onclick="closeModal()">Tutup</button>
        </div>
    </div>

    <footer class="footer">
        &copy; 2024 Dapur Siswa Madani UPSI. Hak Cipta Terpelihara.
    </footer>

    <script>
        function showDetail(el) {
            document.getElementById('dmNama').textContent = el.dataset.name;
            document.getElementById('dmMatrik').textContent = el.dataset.matrik;
            document.getElementById('dmEmel').textContent = el.dataset.email;
            document.getElementById('dmFakulti').textContent = el.dataset.faculty;
            document.getElementById('dmProgram').textContent = el.dataset.program;
            document.getElementById('dmTelefon').textContent = el.dataset.phone;
            document.getElementById('dmTarikh').textContent = el.dataset.created;
            document.getElementById('userModal').classList.add('show');
        }

        function closeModal() {
            document.getElementById('userModal').classList.remove('show');
        }

        document.getElementById('userModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });
    </script>

</x-admin-layout>
