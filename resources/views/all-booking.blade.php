<x-admin-layout active="tempahan-semua" title="Semua Tempahan" subtitle="Lihat semua rekod tempahan dapur.">

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

        .date-input {
            padding: 9px 10px;
            border: 1.5px solid #d1d5db;
            border-radius: 6px;
            font-size: 13px;
            color: #374151;
            outline: none;
            background: #fff;
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

        .action-wrap { display: flex; align-items: center; justify-content: center; gap: 6px; }

        .action-btn {
            height: 28px;
            padding: 0 10px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 11.5px;
            font-weight: 700;
            transition: filter 0.15s;
            color: #fff;
        }

        .action-btn:hover { filter: brightness(0.9); }
        .action-btn.approve { background: #16a34a; }
        .action-btn.reject { background: #dc2626; }

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

        .badge-disahkan  { background: #dcfce7; color: #15803d; border-color: #bbf7d0; }
        .badge-menunggu  { background: #fff9db; color: #d97706; border-color: #fef08a; }
        .badge-dibatalkan{ background: #fee2e2; color: #b91c1c; border-color: #fecaca; }

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

        @media (max-width: 640px) {
            .content { padding: 16px; }
        }
    </style>
    @endpush

    <main class="content">

        @if (session('success'))
            <div class="success-msg">{{ session('success') }}</div>
        @endif

        <div class="table-card">

            <form class="table-toolbar" method="GET" action="{{ route('all-booking') }}">
                <div class="search-wrap">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                    <input type="text" name="search" placeholder="Cari nama, lokasi, atau dapur..." value="{{ request('search') }}">
                </div>

                <select class="filter-select" name="dapur" onchange="this.form.submit()">
                    <option value="">Semua Dapur</option>
                    @foreach ($dapurList as $dapurName)
                        <option value="{{ $dapurName }}" {{ request('dapur') === $dapurName ? 'selected' : '' }}>{{ $dapurName }}</option>
                    @endforeach
                </select>

                <select class="filter-select" name="status" onchange="this.form.submit()">
                    <option value="semua" {{ request('status', 'semua') === 'semua' ? 'selected' : '' }}>Semua Status</option>
                    <option value="disahkan" {{ request('status') === 'disahkan' ? 'selected' : '' }}>Disahkan</option>
                    <option value="menunggu" {{ request('status') === 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="dibatalkan" {{ request('status') === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                </select>

                <input type="date" class="date-input" name="date" value="{{ request('date') }}" onchange="this.form.submit()" placeholder="Semua Tarikh">
            </form>

            @if ($bookings->isEmpty())
                <div class="empty-msg">Tiada tempahan dijumpai.</div>
            @else
                <table>
                    <thead>
                        <tr>
                            <th class="col-bil">Bil.</th>
                            <th>Pemohon</th>
                            <th>No. Matrik</th>
                            <th>Emel</th>
                            <th>Lokasi</th>
                            <th>Dapur</th>
                            <th>Tarikh</th>
                            <th>Masa</th>
                            <th>Status</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $b)
                            <tr>
                                <td class="col-bil">{{ $loop->iteration + (($bookings->currentPage() - 1) * $bookings->perPage()) }}</td>
                                <td>{{ $b->nama }}</td>
                                <td>{{ $b->matrik }}</td>
                                <td>{{ $b->emel }}</td>
                                <td>{{ $b->location_code }}</td>
                                <td>{{ $b->kitchen_name }}</td>
                                <td>{{ \Carbon\Carbon::parse($b->date)->format('d/m/Y') }}</td>
                                <td>{{ $b->start_time }} – {{ $b->end_time }}</td>
                                <td>
                                    @if ($b->status === 'approved')
                                        <span class="badge badge-disahkan">Disahkan</span>
                                    @elseif ($b->status === 'rejected')
                                        <span class="badge badge-dibatalkan">Dibatalkan</span>
                                    @else
                                        <span class="badge badge-menunggu">Menunggu</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-wrap">
                                        @if ($b->status === 'pending')
                                            <form method="POST" action="{{ route('bookings.status', $b->id) }}" style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="action-btn approve">Terima</button>
                                            </form>
                                            <form method="POST" action="{{ route('bookings.status', $b->id) }}" style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="rejected">
                                                <input type="hidden" name="rejection_reason" value="Ditolak oleh pentadbir">
                                                <button type="submit" class="action-btn reject">Tolak</button>
                                            </form>
                                        @elseif ($b->status === 'approved')
                                            <form method="POST" action="{{ route('bookings.status', $b->id) }}" style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="rejected">
                                                <input type="hidden" name="rejection_reason" value="Dibatalkan oleh pentadbir">
                                                <button type="submit" class="action-btn reject">Batal</button>
                                            </form>
                                        @elseif ($b->status === 'rejected')
                                            <form method="POST" action="{{ route('bookings.status', $b->id) }}" style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="action-btn approve">Luluskan</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if ($bookings->hasPages())
                    <div class="pagination">
                        <span class="pag-info">Memaparkan {{ $bookings->firstItem() }} hingga {{ $bookings->lastItem() }} daripada {{ $bookings->total() }} rekod</span>
                        <div class="pag-pages">
                            @if (! $bookings->onFirstPage())
                                <a href="{{ $bookings->previousPageUrl() }}" class="pag-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>
                                </a>
                            @endif

                            @foreach ($bookings->getUrlRange(1, $bookings->lastPage()) as $page => $url)
                                <a href="{{ $url }}" class="pag-btn {{ $page == $bookings->currentPage() ? 'active' : '' }}">{{ $page }}</a>
                            @endforeach

                            @if ($bookings->hasMorePages())
                                <a href="{{ $bookings->nextPageUrl() }}" class="pag-btn">
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

</x-admin-layout>
