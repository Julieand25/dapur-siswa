<x-admin-layout active="pemberitahuan" title="Edit Pemberitahuan" subtitle="Kemaskini pemberitahuan sedia ada.">

    @push('styles')
    <style>
        .content { padding: 28px; flex: 1; }

        .back-link {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 13px; font-weight: 600; color: #6b7280;
            text-decoration: none; margin-bottom: 20px; transition: color 0.15s;
        }

        .back-link:hover { color: #374151; }
        .back-link svg { width: 15px; height: 15px; }

        .form-container { max-width: 700px; }

        .form-card {
            background: #fff; border-radius: 10px; border: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05); padding: 28px;
        }

        .form-card-title {
            font-size: 14.5px; font-weight: 700; color: #111827;
            margin-bottom: 24px; padding-bottom: 14px;
            border-bottom: 1px solid #f3f4f6;
        }

        .form-group { margin-bottom: 20px; }

        .form-label {
            display: block; font-size: 13px; font-weight: 600;
            color: #374151; margin-bottom: 6px;
        }

        .form-label .required { color: #dc2626; margin-left: 2px; }

        .form-input {
            width: 100%; padding: 10px 14px; border: 1.5px solid #d1d5db;
            border-radius: 6px; font-size: 13px; color: #374151; outline: none;
            transition: border-color 0.15s;
        }

        .form-input:focus { border-color: #1a56db; }
        .form-input.is-invalid { border-color: #dc2626; }

        .form-textarea {
            width: 100%; padding: 12px 14px; border: 1.5px solid #d1d5db;
            border-radius: 6px; font-size: 13px; color: #374151; outline: none;
            transition: border-color 0.15s; resize: vertical; min-height: 200px;
            font-family: inherit; line-height: 1.7;
        }

        .form-textarea:focus { border-color: #1a56db; }

        .form-hint {
            font-size: 11.5px; color: #9ca3af; margin-top: 6px; line-height: 1.5;
        }

        .form-error {
            font-size: 11.5px; color: #dc2626; margin-top: 4px; display: block;
        }

        .form-buttons {
            display: flex; gap: 12px; justify-content: flex-end;
            padding-top: 20px; border-top: 1px solid #f3f4f6; margin-top: 8px;
        }

        .btn-cancel {
            height: 40px; padding: 0 24px; border-radius: 6px; font-size: 13.5px;
            font-weight: 700; cursor: pointer; background: #fff; color: #374151;
            border: 1.5px solid #d1d5db; transition: background 0.15s;
            text-decoration: none; display: inline-flex; align-items: center;
        }

        .btn-cancel:hover { background: #f3f4f6; }

        .btn-submit {
            height: 40px; padding: 0 28px; border-radius: 6px; font-size: 13.5px;
            font-weight: 700; cursor: pointer; background: #1a56db; color: #fff;
            border: none; display: inline-flex; align-items: center; gap: 8px;
            transition: background 0.15s;
        }

        .btn-submit:hover { background: #1e40af; }
        .btn-submit svg { width: 16px; height: 16px; }

        .footer { text-align: center; padding: 16px 28px; font-size: 12px; color: #9ca3af; border-top: 1px solid #e5e7eb; background: #fff; margin-top: auto; }

        @media (max-width: 640px) { .content { padding: 16px; } .form-card { padding: 20px; } }
    </style>
    @endpush

    <main class="content">
        <a href="{{ route('pemberitahuan.index') }}" class="back-link">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Pemberitahuan
        </a>

        <div class="form-container">
            <form class="form-card" method="POST" action="{{ route('pemberitahuan.update', $announcement) }}">
                @csrf
                @method('PUT')

                <div class="form-card-title">Edit Pemberitahuan</div>

                <div class="form-group">
                    <label class="form-label">Tajuk <span class="required">*</span></label>
                    <input type="text" class="form-input @error('title') is-invalid @enderror" name="title" value="{{ old('title', $announcement->title) }}" required>
                    @error('title') <span class="form-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Kandungan <span class="required">*</span></label>
                    <textarea class="form-textarea @error('content') is-invalid @enderror" name="content" required>{{ old('content', $announcement->content) }}</textarea>
                    <div class="form-hint">
                        Gunakan <strong>1. 2. 3.</strong> untuk senarai bernombor atau <strong>-</strong> untuk senarai bullet.
                        Kandungan akan dipaparkan seperti yang diatur di aplikasi pengguna.
                    </div>
                    @error('content') <span class="form-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-buttons">
                    <a href="{{ route('pemberitahuan.index') }}" class="btn-cancel">Batal</a>
                    <button type="submit" class="btn-submit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </main>

    <footer class="footer">
        &copy; 2024 Dapur Siswa Madani UPSI. Hak Cipta Terpelihara.
    </footer>

</x-admin-layout>
