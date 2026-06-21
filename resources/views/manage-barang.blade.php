<x-admin-layout active="dapur" title="Urus Barang — {{ $dapur->nama_dapur }}" subtitle="{{ $dapur->lokasi }} — Rekod penggunaan peralatan dan bahan masakan.">

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

        .tab-row {
            display: flex;
            gap: 0;
            margin-bottom: 20px;
            border-bottom: 2px solid #e5e7eb;
        }

        .tab-btn {
            padding: 10px 24px;
            font-size: 13.5px;
            font-weight: 600;
            color: #6b7280;
            background: none;
            border: none;
            border-bottom: 2px solid transparent;
            margin-bottom: -2px;
            cursor: pointer;
            transition: color 0.15s, border-color 0.15s;
        }

        .tab-btn:hover { color: #374151; }

        .tab-btn.active {
            color: #1a56db;
            border-bottom-color: #1a56db;
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
            padding: 14px 20px;
            border-bottom: 1px solid #f3f4f6;
            flex-wrap: wrap;
        }

        .btn-tambah-barang {
            height: 36px;
            padding: 0 16px;
            border: none;
            border-radius: 6px;
            font-size: 12.5px;
            font-weight: 700;
            color: #fff;
            background: #1a56db;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: background 0.15s;
            text-decoration: none;
            margin-left: auto;
        }

        .btn-tambah-barang:hover { background: #1e40af; }

        .btn-tambah-barang svg {
            width: 14px;
            height: 14px;
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
            padding: 12px 16px;
            color: #374151;
            vertical-align: middle;
        }

        tbody td:last-child { text-align: center; }

        .badge-tersedia {
            font-size: 11px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 999px;
            background: #ecfdf5;
            color: #059669;
            border: 1px solid #a7f3d0;
            white-space: nowrap;
        }

        .badge-rosak {
            font-size: 11px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 999px;
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
            white-space: nowrap;
        }

        .badge-diselenggara {
            font-size: 11px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 999px;
            background: #fff7ed;
            color: #ea580c;
            border: 1px solid #fed7aa;
            white-space: nowrap;
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
            margin: 0 2px;
        }

        .btn-icon:hover {
            background: #f3f4f6;
            color: #374151;
        }

        .btn-icon svg {
            width: 13px;
            height: 13px;
        }

        .btn-icon.delete-icon:hover {
            background: #fef2f2;
            color: #dc2626;
            border-color: #fecaca;
        }

        .tab-content { display: none; }
        .tab-content.active { display: block; }

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

        .modal-form-group {
            margin-bottom: 16px;
        }

        .modal-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 5px;
        }

        .modal-input {
            width: 100%;
            padding: 9px 12px;
            border: 1.5px solid #d1d5db;
            border-radius: 6px;
            font-size: 13px;
            color: #374151;
            outline: none;
            transition: border-color 0.15s;
        }

        .modal-input:focus { border-color: #1a56db; }

        .modal-select {
            width: 100%;
            padding: 9px 30px 9px 12px;
            border: 1.5px solid #d1d5db;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            color: #374151;
            background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6' viewBox='0 0 10 6'%3E%3Cpath d='M1 1l4 4 4-4' stroke='%236b7280' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E") no-repeat right 12px center;
            appearance: none;
            -webkit-appearance: none;
            outline: none;
            cursor: pointer;
        }

        .modal-buttons {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 22px;
        }

        .modal-btn-cancel {
            height: 38px;
            padding: 0 24px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            background: #f3f4f6;
            color: #374151;
            border: 1px solid #d1d5db;
            transition: background 0.15s;
        }

        .modal-btn-cancel:hover { background: #e5e7eb; }

        .modal-btn-save {
            height: 38px;
            padding: 0 24px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            background: #1a56db;
            color: #fff;
            border: none;
            transition: background 0.15s;
        }

        .modal-btn-save:hover { background: #1e40af; }

        .success-msg {
            background: #dcfce7;
            color: #15803d;
            border: 1px solid #bbf7d0;
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 12.5px;
            font-weight: 600;
            margin-bottom: 16px;
        }

        .empty-msg {
            text-align: center;
            padding: 30px 20px;
            color: #9ca3af;
            font-size: 13px;
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

        @media (max-width: 640px) {
            .content { padding: 16px; }
            .btn-tambah-barang { margin-left: 0; }
        }
    </style>
    @endpush

    <main class="content">
        <a href="{{ route('dapur.index') }}" class="back-link">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Senarai Dapur
        </a>

        @if (session('success'))
            <div class="success-msg">{{ session('success') }}</div>
        @endif

        <div class="tab-row">
            <button class="tab-btn active" onclick="switchTab('peralatan', this)">Peralatan</button>
            <button class="tab-btn" onclick="switchTab('bahan', this)">Bahan Masak</button>
        </div>

        <div class="tab-content active" id="tab-peralatan">
            <div class="table-card">
                <div class="table-toolbar">
                    <button class="btn-tambah-barang" onclick="openModal('peralatan')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        Tambah Peralatan
                    </button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th style="width:60px;">Bil.</th>
                            <th>Peralatan</th>
                            <th style="width:100px;">Kuantiti</th>
                            <th style="width:140px;">Status</th>
                            <th style="width:100px;">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($peralatans as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->kuantiti }}</td>
                                <td>
                                    <span class="badge-{{ strtolower($p->status) === 'tersedia' ? 'tersedia' : (strtolower($p->status) === 'rosak' ? 'rosak' : 'diselenggara') }}">
                                        {{ $p->status }}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn-icon" title="Edit" onclick="openEditModal('peralatan', {{ $p->id }}, '{{ addslashes($p->nama) }}', {{ $p->kuantiti }}, '{{ $p->status }}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </button>
                                    <form method="POST" action="{{ route('dapur.peralatan.destroy', [$dapur, $p]) }}" style="display:inline;" onsubmit="return confirm('Padam peralatan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-icon delete-icon" title="Padam">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="empty-msg">Tiada peralatan didaftarkan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="tab-content" id="tab-bahan">
            <div class="table-card">
                <div class="table-toolbar">
                    <button class="btn-tambah-barang" onclick="openModal('bahan')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        Tambah Bahan
                    </button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th style="width:60px;">Bil.</th>
                            <th>Bahan</th>
                            <th style="width:100px;">Kuantiti</th>
                            <th style="width:100px;">Unit</th>
                            <th style="width:100px;">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bahans as $b)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $b->nama }}</td>
                                <td>{{ $b->kuantiti }}</td>
                                <td>{{ $b->unit }}</td>
                                <td>
                                    <button class="btn-icon" title="Edit" onclick="openEditModal('bahan', {{ $b->id }}, '{{ addslashes($b->nama) }}', {{ $b->kuantiti }}, '{{ $b->unit }}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </button>
                                    <form method="POST" action="{{ route('dapur.bahan.destroy', [$dapur, $b]) }}" style="display:inline;" onsubmit="return confirm('Padam bahan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-icon delete-icon" title="Padam">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="empty-msg">Tiada bahan didaftarkan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div class="modal-overlay" id="barangModal">
        <div class="modal-card">
            <div class="modal-title" id="modalTitle">Tambah Peralatan</div>
            <form id="modalForm" method="POST" action="">
                @csrf
                <input type="hidden" name="_method" id="modalMethod" value="POST">

                <div class="modal-form-group">
                    <label class="modal-label" id="modalNameLabel">Nama Peralatan</label>
                    <input type="text" class="modal-input" name="nama" id="modalNama" placeholder="Masukkan nama..." required>
                </div>
                <div class="modal-form-group">
                    <label class="modal-label">Kuantiti</label>
                    <input type="number" class="modal-input" name="kuantiti" id="modalKuantiti" placeholder="Cth: 5" min="1" required>
                </div>
                <div class="modal-form-group" id="modalGroupStatus">
                    <label class="modal-label">Status</label>
                    <select class="modal-select" name="status" id="modalStatus">
                        <option value="Tersedia">Tersedia</option>
                        <option value="Rosak">Rosak</option>
                        <option value="Diselenggara">Diselenggara</option>
                    </select>
                </div>
                <div class="modal-form-group" id="modalGroupUnit" style="display:none;">
                    <label class="modal-label">Unit</label>
                    <input type="text" class="modal-input" name="unit" id="modalUnit" placeholder="Cth: Botol, Kg, Pek">
                </div>
                <div class="modal-buttons">
                    <button type="button" class="modal-btn-cancel" onclick="closeModal()">Batal</button>
                    <button type="submit" class="modal-btn-save">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <footer class="footer">
        &copy; 2024 Dapur Siswa Madani UPSI. Hak Cipta Terpelihara.
    </footer>

    <script>
        var dapurId = {{ $dapur->id }};

        function switchTab(tab, el) {
            document.querySelectorAll('.tab-btn').forEach(function(b) { b.classList.remove('active'); });
            document.querySelectorAll('.tab-content').forEach(function(c) { c.classList.remove('active'); });
            el.classList.add('active');
            document.getElementById('tab-' + tab).classList.add('active');
        }

        function openModal(type) {
            document.getElementById('modalForm').action = '/dapur/' + dapurId + '/' + (type === 'peralatan' ? 'peralatan' : 'bahan');
            document.getElementById('modalMethod').value = 'POST';
            document.getElementById('modalNama').value = '';
            document.getElementById('modalKuantiti').value = '';
            document.getElementById('modalUnit').value = '';

            if (type === 'peralatan') {
                document.getElementById('modalTitle').textContent = 'Tambah Peralatan';
                document.getElementById('modalNameLabel').textContent = 'Nama Peralatan';
                document.getElementById('modalGroupStatus').style.display = 'block';
                document.getElementById('modalGroupUnit').style.display = 'none';
                document.getElementById('modalStatus').value = 'Tersedia';
            } else {
                document.getElementById('modalTitle').textContent = 'Tambah Bahan';
                document.getElementById('modalNameLabel').textContent = 'Nama Bahan';
                document.getElementById('modalGroupStatus').style.display = 'none';
                document.getElementById('modalGroupUnit').style.display = 'block';
            }

            document.getElementById('barangModal').classList.add('show');
        }

        function openEditModal(type, id, nama, kuantiti, extra) {
            var base = '/dapur/' + dapurId + '/' + (type === 'peralatan' ? 'peralatan' : 'bahan');
            document.getElementById('modalForm').action = base + '/' + id;
            document.getElementById('modalMethod').value = 'PUT';
            document.getElementById('modalNama').value = nama;
            document.getElementById('modalKuantiti').value = kuantiti;

            if (type === 'peralatan') {
                document.getElementById('modalTitle').textContent = 'Edit Peralatan';
                document.getElementById('modalNameLabel').textContent = 'Nama Peralatan';
                document.getElementById('modalGroupStatus').style.display = 'block';
                document.getElementById('modalGroupUnit').style.display = 'none';
                document.getElementById('modalStatus').value = extra;
            } else {
                document.getElementById('modalTitle').textContent = 'Edit Bahan';
                document.getElementById('modalNameLabel').textContent = 'Nama Bahan';
                document.getElementById('modalGroupStatus').style.display = 'none';
                document.getElementById('modalGroupUnit').style.display = 'block';
                document.getElementById('modalUnit').value = extra;
            }

            document.getElementById('barangModal').classList.add('show');
        }

        function closeModal() {
            document.getElementById('barangModal').classList.remove('show');
        }

        document.getElementById('barangModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });
    </script>

</x-admin-layout>
