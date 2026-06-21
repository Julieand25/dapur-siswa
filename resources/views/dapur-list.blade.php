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
            text-decoration: none;
        }

        .action-links a:hover { text-decoration: underline; }

        .action-links .link-ubah { color: #1a56db; }
        .action-links .link-ubah:hover { color: #1e40af; }
        .action-links .link-urus { color: #1a56db; }
        .action-links .link-urus:hover { color: #1e40af; }
        .action-links .link-padam { color: #dc2626; }
        .action-links .link-padam:hover { color: #b91c1c; }

        .success-msg {
            background: #dcfce7;
            color: #15803d;
            border: 1px solid #bbf7d0;
            padding: 10px 16px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 16px;
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

        @if (session('success'))
            <div class="success-msg">{{ session('success') }}</div>
        @endif

        <div class="table-card">

            <form class="table-toolbar" method="GET" action="{{ route('dapur.index') }}">
                <div class="search-wrap">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                    <input type="text" name="search" placeholder="Cari dapur..." value="{{ request('search') }}">
                </div>

                <select class="filter-select" name="lokasi" onchange="this.form.submit()">
                    <option value="">Semua Lokasi</option>
                    <option value="KHAR" {{ request('lokasi') === 'KHAR' ? 'selected' : '' }}>KHAR</option>
                    <option value="KUO" {{ request('lokasi') === 'KUO' ? 'selected' : '' }}>KUO</option>
                    <option value="KAHS" {{ request('lokasi') === 'KAHS' ? 'selected' : '' }}>KAHS</option>
                    <option value="KAB" {{ request('lokasi') === 'KAB' ? 'selected' : '' }}>KAB</option>
                    <option value="KZ" {{ request('lokasi') === 'KZ' ? 'selected' : '' }}>KZ</option>
                </select>

                <select class="filter-select" name="status" onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="tersedia" {{ request('status') === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="tidak-tersedia" {{ request('status') === 'tidak-tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                </select>
            </form>

            @if ($dapurs->isEmpty())
                <div class="empty-msg">Tiada dapur dijumpai.</div>
            @else
                <table>
                    <thead>
                        <tr>
                            <th class="col-bil">Bil.</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th>Dapur</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dapurs as $dapur)
                            <tr>
                                <td class="col-bil">{{ $loop->iteration + (($dapurs->currentPage() - 1) * $dapurs->perPage()) }}</td>
                                <td>{{ $dapur->lokasi }}</td>
                                <td>
                                    <span class="badge {{ $dapur->status === 'tersedia' ? 'badge-tersedia' : 'badge-tidak-tersedia' }}">
                                        {{ $dapur->status === 'tersedia' ? 'Tersedia' : 'Tidak Tersedia' }}
                                    </span>
                                </td>
                                <td class="col-dapur">{{ $dapur->nama_dapur }}</td>
                                <td>
                                    <div class="action-links">
                                        <a href="{{ route('dapur.edit', $dapur) }}" class="link-ubah">Ubah Dapur</a>
                                        <a href="{{ route('dapur.barang', $dapur) }}" class="link-urus">Urus Barang</a>
                                        <a href="#" class="link-padam" onclick="confirmDelete(event, '{{ route('dapur.destroy', $dapur) }}', '{{ $dapur->nama_dapur }}')">Padam</a>
                                        <form id="delete-form-{{ $dapur->id }}" method="POST" action="{{ route('dapur.destroy', $dapur) }}" style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if ($dapurs->hasPages())
                    <div class="pagination">
                        <span class="pag-info">Memaparkan {{ $dapurs->firstItem() }} hingga {{ $dapurs->lastItem() }} daripada {{ $dapurs->total() }} rekod</span>
                        <div class="pag-pages">
                            @if (! $dapurs->onFirstPage())
                                <a href="{{ $dapurs->previousPageUrl() }}" class="pag-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>
                                </a>
                            @endif

                            @foreach ($dapurs->getUrlRange(1, $dapurs->lastPage()) as $page => $url)
                                <a href="{{ $url }}" class="pag-btn {{ $page == $dapurs->currentPage() ? 'active' : '' }}">{{ $page }}</a>
                            @endforeach

                            @if ($dapurs->hasMorePages())
                                <a href="{{ $dapurs->nextPageUrl() }}" class="pag-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </main>

    <footer class="footer">
        &copy; 2024 Dapur Siswa Madani UPSI. Hak Cipta Terpelihara.
    </footer>

    <script>
        function confirmDelete(e, url, name) {
            e.preventDefault();
            if (confirm('Padam "' + name + '"? Tindakan ini tidak boleh dikembalikan.')) {
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = url;
                form.style.display = 'none';
                form.innerHTML = '@csrf @method('DELETE')';
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>

</x-admin-layout>
