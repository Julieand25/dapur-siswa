<x-admin-layout active="dapur" title="Edit Dapur" subtitle="Kemaskini maklumat dapur sedia ada.">

    @push('styles')
    <style>
        .content {
            padding: 28px;
            flex: 1;
        }

        .form-container {
            max-width: 600px;
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

        .form-card {
            background: #fff;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            padding: 28px;
        }

        .form-card-title {
            font-size: 14.5px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 24px;
            padding-bottom: 14px;
            border-bottom: 1px solid #f3f4f6;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }

        .form-label .required {
            color: #dc2626;
            margin-left: 2px;
        }

        .form-input {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid #d1d5db;
            border-radius: 6px;
            font-size: 13px;
            color: #374151;
            outline: none;
            transition: border-color 0.15s;
        }

        .form-input:focus { border-color: #1a56db; }

        .form-select {
            width: 100%;
            padding: 10px 32px 10px 14px;
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
            transition: border-color 0.15s;
        }

        .form-select:focus { border-color: #1a56db; }

        .form-hint {
            font-size: 11.5px;
            color: #9ca3af;
            margin-top: 5px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .status-toggle-group {
            display: flex;
            gap: 12px;
        }

        .status-option {
            flex: 1;
        }

        .status-option input {
            display: none;
        }

        .status-option label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 14px;
            border: 1.5px solid #d1d5db;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.15s;
            background: #fff;
            color: #6b7280;
        }

        .status-option input:checked + label {
            background: #ecfdf5;
            border-color: #059669;
            color: #059669;
        }

        .status-option input:checked + label .dot {
            background: #059669;
        }

        .status-option label .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #d1d5db;
            flex-shrink: 0;
            transition: background 0.15s;
        }

        .status-option.tidak input:checked + label {
            background: #fef2f2;
            border-color: #dc2626;
            color: #dc2626;
        }

        .status-option.tidak input:checked + label .dot {
            background: #dc2626;
        }

        .form-buttons {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            padding-top: 20px;
            border-top: 1px solid #f3f4f6;
            margin-top: 8px;
        }

        .btn-cancel {
            height: 40px;
            padding: 0 24px;
            border-radius: 6px;
            font-size: 13.5px;
            font-weight: 700;
            cursor: pointer;
            background: #fff;
            color: #374151;
            border: 1.5px solid #d1d5db;
            transition: background 0.15s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .btn-cancel:hover { background: #f3f4f6; }

        .btn-submit {
            height: 40px;
            padding: 0 28px;
            border-radius: 6px;
            font-size: 13.5px;
            font-weight: 700;
            cursor: pointer;
            background: #1a56db;
            color: #fff;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background 0.15s;
        }

        .btn-submit:hover { background: #1e40af; }

        .btn-submit svg {
            width: 16px;
            height: 16px;
        }

        @media (max-width: 640px) {
            .content { padding: 16px; }
            .form-card { padding: 20px; }
            .form-row { grid-template-columns: 1fr; gap: 0; }
        }
    </style>
    @endpush

    <main class="content">
        <a href="{{ route('dapur.index') }}" class="back-link">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Senarai Dapur
        </a>

        <div class="form-container">
            <form class="form-card" method="POST" action="{{ route('dapur.update', $dapur) }}">
                @csrf
                @method('PUT')
                <div class="form-card-title">Edit Maklumat Dapur</div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Lokasi <span class="required">*</span></label>
                        <select class="form-select" name="lokasi" required>
                            <option value="">Pilih lokasi</option>
                            <option value="KHAR" {{ old('lokasi', $dapur->lokasi) === 'KHAR' ? 'selected' : '' }}>KHAR</option>
                            <option value="KUO" {{ old('lokasi', $dapur->lokasi) === 'KUO' ? 'selected' : '' }}>KUO</option>
                            <option value="KAHS" {{ old('lokasi', $dapur->lokasi) === 'KAHS' ? 'selected' : '' }}>KAHS</option>
                            <option value="KAB" {{ old('lokasi', $dapur->lokasi) === 'KAB' ? 'selected' : '' }}>KAB</option>
                            <option value="KZ" {{ old('lokasi', $dapur->lokasi) === 'KZ' ? 'selected' : '' }}>KZ</option>
                        </select>
                        @error('lokasi')<span class="error-msg" style="font-size:12px;color:#dc2626;margin-top:4px;">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nama Dapur <span class="required">*</span></label>
                        <input type="text" class="form-input" name="nama_dapur" value="{{ old('nama_dapur', $dapur->nama_dapur) }}" required>
                        @error('nama_dapur')<span class="error-msg" style="font-size:12px;color:#dc2626;margin-top:4px;">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Status</label>
                    <div class="status-toggle-group">
                        <div class="status-option">
                            <input type="radio" name="status" id="status-tersedia" value="tersedia" {{ old('status', $dapur->status) === 'tersedia' ? 'checked' : '' }}>
                            <label for="status-tersedia">
                                <span class="dot"></span>
                                Tersedia
                            </label>
                        </div>
                        <div class="status-option tidak">
                            <input type="radio" name="status" id="status-tidak" value="tidak-tersedia" {{ old('status', $dapur->status) === 'tidak-tersedia' ? 'checked' : '' }}>
                            <label for="status-tidak">
                                <span class="dot"></span>
                                Tidak Tersedia
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Maksimum Orang <span class="required">*</span></label>
                    <input type="number" class="form-input" name="max_orang" value="{{ old('max_orang', $dapur->max_orang) }}" min="1" required>
                    @error('max_orang')<span class="error-msg" style="font-size:12px;color:#dc2626;margin-top:4px;">{{ $message }}</span>@enderror
                    <div class="form-hint">Jumlah maksimum pengguna yang dibenarkan pada satu masa.</div>
                </div>

                <div class="form-buttons">
                    <a href="{{ route('dapur.index') }}" class="btn-cancel">Batal</a>
                    <button type="submit" class="btn-submit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </main>

</x-admin-layout>
