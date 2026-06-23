<x-admin-layout active="laporan-maklumbalas" title="Butiran Maklum Balas" subtitle="Maklumat lengkap maklum balas pengguna.">

    @push('styles')
    <style>
        .content { padding: 28px; flex: 1; }

        .back-link {
            display: inline-flex; align-items: center; gap: 6px; font-size: 13px;
            font-weight: 600; color: #6b7280; text-decoration: none; margin-bottom: 20px;
            transition: color 0.15s;
        }

        .back-link:hover { color: #374151; }
        .back-link svg { width: 15px; height: 15px; }

        .detail-card {
            background: #fff; border-radius: 10px; border: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05); padding: 28px; max-width: 640px;
        }

        .detail-title {
            font-size: 15px; font-weight: 700; color: #111827;
            margin-bottom: 24px; padding-bottom: 14px; border-bottom: 1px solid #f3f4f6;
            display: flex; align-items: center; gap: 10px;
        }

        .detail-row {
            display: flex; padding: 12px 0; border-bottom: 1px solid #f9fafb;
        }

        .detail-row:last-child { border-bottom: none; }

        .dlabel {
            font-size: 13px; font-weight: 600; color: #6b7280;
            width: 160px; flex-shrink: 0;
        }

        .dvalue { font-size: 13px; font-weight: 500; color: #111827; flex: 1; }

        .stars { display: inline-flex; gap: 2px; }
        .stars svg { width: 16px; height: 16px; }
        .star-filled { color: #f59e0b; }
        .star-empty { color: #d1d5db; }

        .comment-box {
            margin-top: 20px; background: #f9fafb; border-radius: 8px; padding: 16px 18px;
        }

        .comment-box-label {
            font-size: 12px; font-weight: 600; color: #9ca3af;
            text-transform: uppercase; letter-spacing: 0.04em; margin-bottom: 8px;
        }

        .comment-box-text {
            font-size: 13.5px; color: #374151; line-height: 1.7;
        }

        .footer { text-align: center; padding: 16px 28px; font-size: 12px; color: #9ca3af; border-top: 1px solid #e5e7eb; background: #fff; margin-top: auto; }

        @media (max-width: 640px) {
            .content { padding: 16px; }
            .detail-card { padding: 20px; }
            .dlabel { width: 120px; }
        }
    </style>
    @endpush

    <main class="content">
        <a href="{{ route('laporan.maklumbalas') }}" class="back-link">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Maklum Balas
        </a>

        <div class="detail-card">
            <div class="detail-title">Butiran Maklum Balas</div>

            <div class="detail-row">
                <span class="dlabel">Nama</span>
                <span class="dvalue">{{ $profile->name ?? $user->email ?? '—' }}</span>
            </div>
            <div class="detail-row">
                <span class="dlabel">No. Matrik</span>
                <span class="dvalue">{{ $profile->matrik ?? '—' }}</span>
            </div>
            <div class="detail-row">
                <span class="dlabel">Emel</span>
                <span class="dvalue">{{ $user->email ?? '—' }}</span>
            </div>
            <div class="detail-row">
                <span class="dlabel">Tarikh</span>
                <span class="dvalue">{{ \Carbon\Carbon::parse($feedback->created_at)->timezone('Asia/Kuala_Lumpur')->locale('ms')->isoFormat('D MMM YYYY, h:mm A') }}</span>
            </div>
            <div class="detail-row">
                <span class="dlabel">Penilaian</span>
                <span class="dvalue"><span class="stars" data-rating="{{ $feedback->keseluruhan }}"></span></span>
            </div>

            @if ($feedback->komen)
            <div class="comment-box">
                <div class="comment-box-label">Komen</div>
                <div class="comment-box-text">{{ $feedback->komen }}</div>
            </div>
            @endif

            @if ($feedback->cadangan)
            <div class="comment-box" style="border:1px solid #fde68a;background:#fffbeb;">
                <div class="comment-box-label">Cadangan</div>
                <div class="comment-box-text">{{ $feedback->cadangan }}</div>
            </div>
            @endif
        </div>
    </main>

    <footer class="footer">
        &copy; 2024 Dapur Siswa Madani UPSI. Hak Cipta Terpelihara.
    </footer>

    <script>
        function renderStars() {
            document.querySelectorAll('.stars').forEach(function(el) {
                var rating = parseInt(el.getAttribute('data-rating')) || 0;
                var html = '';
                for (var i = 1; i <= 5; i++) {
                    if (i <= rating) {
                        html += '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="star-filled"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>';
                    } else {
                        html += '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="star-empty"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>';
                    }
                }
                el.innerHTML = html;
            });
        }
        document.addEventListener('DOMContentLoaded', renderStars);
    </script>

</x-admin-layout>
