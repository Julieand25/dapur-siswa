<x-admin-layout active="tetapan" title="Tetapan Akaun" subtitle="Urus maklumat peribadi dan keselamatan akaun anda.">

    @push('styles')
    <style>
        .content {
            padding: 28px;
            flex: 1;
        }

        .settings-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            align-items: start;
        }

        .card {
            background: #fff;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            padding: 28px;
        }

        .card.full {
            grid-column: 1 / -1;
        }

        .card-title {
            font-size: 14.5px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid #f3f4f6;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-title svg {
            width: 18px;
            height: 18px;
            color: #6b7280;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 5px;
        }

        .form-input {
            width: 100%;
            padding: 9px 12px;
            border: 1.5px solid #d1d5db;
            border-radius: 6px;
            font-size: 13px;
            color: #374151;
            outline: none;
            transition: border-color 0.15s;
        }

        .form-input:focus { border-color: #1a56db; }

        .form-input:disabled {
            background: #f9fafb;
            color: #9ca3af;
            cursor: not-allowed;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .btn-save {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            height: 38px;
            padding: 0 22px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            background: #1a56db;
            color: #fff;
            border: none;
            transition: background 0.15s;
            margin-top: 4px;
        }

        .btn-save:hover { background: #1e40af; }

        .btn-save svg {
            width: 14px;
            height: 14px;
        }

        .photo-section {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 16px;
        }

        .photo-preview {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #1a56db;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
            overflow: hidden;
        }

        .photo-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .photo-preview-wrapper {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .photo-plus {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 24px;
            height: 24px;
            background: #1a56db;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #fff;
        }

        .photo-plus svg {
            width: 14px;
            height: 14px;
            color: #fff;
        }

        .photo-hint {
            font-size: 11.5px;
            color: #9ca3af;
            margin-top: 4px;
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
            .settings-grid { grid-template-columns: 1fr; }
            .form-row { grid-template-columns: 1fr; }
        }

        @media (max-width: 640px) {
            .content { padding: 16px; }
            .card { padding: 20px; }
            .photo-section { flex-direction: column; align-items: flex-start; }
        }
    </style>
    @endpush

    <main class="content">

        <div class="settings-grid">

            <div class="card">
                <div class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Maklumat Peribadi
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nama Penuh</label>
                        <input type="text" class="form-input" value="Pentadbir" placeholder="Nama penuh">
                    </div>
                    <div class="form-group">
                        <label class="form-label">No. Matrik</label>
                        <input type="text" class="form-input" value="D20240000001" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Emel</label>
                    <input type="email" class="form-input" value="admin@dapursiswa.edu.my" placeholder="Emel">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Fakulti / Jabatan</label>
                        <input type="text" class="form-input" value="Jabatan Hal Ehwal Pelajar" disabled>
                    </div>
                    <div class="form-group">
                        <label class="form-label">No. Telefon</label>
                        <input type="text" class="form-input" value="019-123 4567" placeholder="No. telefon">
                    </div>
                </div>

                <div class="photo-section">
                    <input type="file" id="photoInput" accept="image/*" style="display:none;" onchange="previewPhoto(this)">
                    <label class="photo-preview-wrapper" for="photoInput">
                        <div class="photo-preview" id="photoPreview">P</div>
                        <div class="photo-plus">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        </div>
                    </label>
                </div>
                <div class="photo-hint">Format: JPG, PNG. Maksimum 2MB.</div>

                <button class="btn-save">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    Simpan Perubahan
                </button>
            </div>

            <div class="card full">
                <div class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                    Tukar Kata Laluan
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Kata Laluan Semasa</label>
                        <input type="password" class="form-input" placeholder="Masukkan kata laluan semasa">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Kata Laluan Baharu</label>
                        <input type="password" class="form-input" placeholder="Masukkan kata laluan baharu">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Sahkan Kata Laluan Baharu</label>
                        <input type="password" class="form-input" placeholder="Sahkan kata laluan baharu">
                    </div>
                </div>

                <button class="btn-save">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    Kemas Kini Kata Laluan
                </button>
            </div>

        </div>
    </main>

    <footer class="footer">
        &copy; 2024 Dapur Siswa Madani UPSI. Hak Cipta Terpelihara.
    </footer>

    <script>
        function previewPhoto(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var preview = document.getElementById('photoPreview');
                    preview.innerHTML = '<img src="' + e.target.result + '" alt="Foto Profil">';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removePhoto() {
            document.getElementById('photoPreview').innerHTML = 'P';
        }
    </script>

</x-admin-layout>
