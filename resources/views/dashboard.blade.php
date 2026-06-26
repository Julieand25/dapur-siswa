<x-admin-layout active="dashboard" title="Dashboard Tempahan" subtitle="Sistem Tempahan Dapur Siswa Madani UPSI">

    @push('styles')
    <style>
        .content {
            padding: 28px;
            flex: 1;
        }

        .stat-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin-bottom: 24px;
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

        .stat-icon.blue   { background: #1a56db; color: #fff; }
        .stat-icon.green  { background: #16a34a; color: #fff; }
        .stat-icon.amber  { background: #d97706; color: #fff; }
        .stat-icon.indigo { background: #4f46e5; color: #fff; }
        .stat-icon.red    { background: #dc2626; color: #fff; }

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

        .alert-card {
            background: #fff;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            overflow: hidden;
            margin-top: 24px;
        }

        .alert-header {
            padding: 14px 20px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
            font-weight: 700;
            color: #111827;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .alert-header svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            color: #6b7280;
        }

        .alert-empty {
            text-align: center;
            padding: 30px 20px;
            color: #9ca3af;
            font-size: 13px;
        }

        .alert-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13.5px;
        }

        .alert-table thead tr {
            background: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
        }

        .alert-table thead th {
            padding: 12px 16px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .alert-table tbody tr {
            border-bottom: 1px solid #f3f4f6;
        }

        .alert-table tbody tr:last-child { border-bottom: none; }

        .alert-table tbody td {
            padding: 13px 16px;
            color: #374151;
        }



        .qty-low { color: #d97706; font-weight: 600; }
        .qty-zero { color: #dc2626; font-weight: 600; }

        .success-msg {
        }

        .alert-table thead tr {
            background: #fafafa;
        }

        .alert-table thead th {
            padding: 10px 16px;
            text-align: left;
            font-size: 11px;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .alert-table tbody tr {
            border-bottom: 1px solid #f3f4f6;
        }

        .alert-table tbody tr:last-child { border-bottom: none; }
        .alert-table tbody td {
            padding: 11px 16px;
            color: #374151;
            vertical-align: middle;
        }

        .alert-table .qty-low { color: #d97706; font-weight: 700; }
        .alert-table .qty-zero { color: #dc2626; font-weight: 700; }
        .alert-table .qty-ok { color: #374151; font-weight: 500; }

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


        .view-all-link {
            display: block;
            text-align: center;
            padding: 14px 20px;
            border-top: 1px solid #f3f4f6;
            font-size: 13px;
            font-weight: 600;
            color: #1a56db;
            text-decoration: none;
            transition: background 0.12s;
        }

        .view-all-link:hover { background: #f0f4ff; }

        .footer {
            text-align: center;
            padding: 16px 28px;
            font-size: 12px;
            color: #9ca3af;
            border-top: 1px solid #e5e7eb;
            background: #fff;
        }

        @media (max-width: 900px) {
            .stat-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 640px) {
            .stat-grid { grid-template-columns: 1fr 1fr; }
            .content { padding: 16px; }
        }
    </style>
    @endpush

    <!-- Content -->
    <main class="content">

        <!-- Stat Cards -->
        <div class="stat-grid">

            <div class="stat-card">
                <div class="stat-body">
                    <div class="stat-num">{{ $todayCount }}</div>
                    <div class="stat-label">Tempahan Hari Ini</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-body">
                    <div class="stat-num">{{ $pendingCount }}</div>
                    <div class="stat-label">Menunggu Kelulusan</div>
                </div>
            </div>

        </div>

        @if (session('success'))
            <div class="success-msg">{{ session('success') }}</div>
        @endif

        <!-- Table Card -->
        <div class="table-card">

            <!-- Toolbar -->
            <form class="table-toolbar" method="GET" action="{{ route('dashboard') }}">
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

                <input type="date" class="date-input" name="date" value="{{ request('date', now()->format('Y-m-d')) }}" onchange="this.form.submit()">

            </form>

            <!-- Table -->
            @if ($bookings->isEmpty())
                <div class="empty-msg">Tiada tempahan dijumpai.</div>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>Pemohon</th>
                            <th>No. Matrik</th>
                            <th>Emel</th>
                            <th>Lokasi</th>
                            <th>Dapur</th>
                            <th>Tarikh</th>
                            <th>Masa</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $b)
                            <tr>
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            <a href="{{ route('all-booking') }}" class="view-all-link">Lihat semua tempahan</a>

        </div>

        @if ($lowStockCount > 0)
        <div class="alert-card">
            <div class="alert-header">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
                Peringatan Stok Rendah
            </div>
            <table class="alert-table">
                <thead>
                    <tr>
                        <th>Bahan</th>
                        <th>Dapur</th>
                        <th>Lokasi</th>
                        <th>Kuantiti</th>
                        <th>Unit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lowStockItems as $item)
                        <tr>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->nama_dapur }}</td>
                            <td>{{ $item->lokasi }}</td>
                            <td class="{{ $item->kuantiti == 0 ? 'qty-zero' : 'qty-low' }}">{{ $item->kuantiti }}</td>
                            <td>{{ $item->unit }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('dapur.index') }}" class="view-all-link">Pergi ke halaman dapur</a>
        </div>
        @endif

    </main>

    <footer class="footer">
        &copy; 2024 Dapur Siswa Madani UPSI. Hak Cipta Terpelihara.
    </footer>

</x-admin-layout>
