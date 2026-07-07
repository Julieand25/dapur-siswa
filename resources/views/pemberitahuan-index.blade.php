<x-admin-layout active="pemberitahuan" title="Pemberitahuan" subtitle="Urus pemberitahuan yang akan dipaparkan kepada pengguna aplikasi.">

    @push('styles')
    <style>
        .content { padding: 28px; flex: 1; }

        .header-row {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 20px; flex-wrap: wrap; gap: 12px;
        }

        .header-row h2 {
            font-size: 16px; font-weight: 700; color: #111827; margin: 0;
        }

        .btn-tambah {
            height: 40px; padding: 0 20px; border: none; border-radius: 6px;
            font-size: 13.5px; font-weight: 700; color: #fff; background: #1a56db;
            cursor: pointer; display: inline-flex; align-items: center; gap: 8px;
            transition: background 0.15s; text-decoration: none;
        }

        .btn-tambah:hover { background: #1e40af; }
        .btn-tambah svg { width: 16px; height: 16px; }

        .table-card {
            background: #fff; border-radius: 10px; border: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05); overflow: hidden;
        }

        .ann-list { padding: 0; margin: 0; }

        .ann-item {
            display: flex; align-items: flex-start; gap: 16px;
            padding: 20px 24px; border-bottom: 1px solid #f3f4f6;
            transition: background 0.1s;
        }

        .ann-item:last-child { border-bottom: none; }
        .ann-item:hover { background: #f9fafb; }

        .ann-icon {
            width: 40px; height: 40px; border-radius: 10px;
            background: #eff6ff; color: #1a56db; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
        }

        .ann-icon svg { width: 20px; height: 20px; }

        .ann-body { flex: 1; min-width: 0; }

        .ann-title {
            font-size: 14px; font-weight: 700; color: #111827;
            margin-bottom: 4px;
        }

        .ann-preview {
            font-size: 12.5px; color: #6b7280; line-height: 1.5;
            margin-bottom: 8px;
        }

        .ann-meta {
            display: flex; align-items: center; gap: 12px;
            font-size: 11.5px; color: #9ca3af;
        }

        .ann-actions {
            display: flex; gap: 6px; flex-shrink: 0; align-items: center;
        }

        .btn-icon {
            width: 30px; height: 30px; border-radius: 6px; border: 1px solid #e5e7eb;
            background: #fff; color: #6b7280; cursor: pointer; display: inline-flex;
            align-items: center; justify-content: center;
            transition: background 0.15s, color 0.15s; text-decoration: none;
        }

        .btn-icon:hover { background: #f3f4f6; color: #374151; }
        .btn-icon.delete:hover { background: #fef2f2; color: #dc2626; border-color: #fecaca; }
        .btn-icon svg { width: 14px; height: 14px; }

        .success-msg {
            background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0;
            padding: 10px 16px; border-radius: 6px; font-size: 13px;
            font-weight: 600; margin-bottom: 20px;
        }

        .empty-msg {
            text-align: center; padding: 50px 20px; color: #9ca3af; font-size: 13px;
        }

        .pagination {
            display: flex; align-items: center; justify-content: space-between;
            padding: 14px 24px; border-top: 1px solid #f3f4f6;
        }

        .pag-info { font-size: 12.5px; color: #6b7280; }
        .pag-pages { display: flex; align-items: center; gap: 4px; }

        .pag-btn {
            width: 30px; height: 30px; border-radius: 6px; border: 1px solid #e5e7eb;
            background: #fff; font-size: 12.5px; color: #374151; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-weight: 500; transition: background 0.12s; text-decoration: none;
        }

        .pag-btn:hover { background: #f3f4f6; }
        .pag-btn.active { background: #1a56db; color: #fff; border-color: #1a56db; font-weight: 700; }
        .pag-btn svg { width: 13px; height: 13px; }

        .footer { text-align: center; padding: 16px 28px; font-size: 12px; color: #9ca3af; border-top: 1px solid #e5e7eb; background: #fff; margin-top: auto; }

        @media (max-width: 640px) { .content { padding: 16px; } .ann-item { flex-direction: column; } .ann-actions { align-self: flex-end; } }
    </style>
    @endpush

    <main class="content">

        @if (session('success'))
            <div class="success-msg">{{ session('success') }}</div>
        @endif

        <div class="header-row">
            <h2>Senarai Pemberitahuan</h2>
            <a href="{{ route('pemberitahuan.create') }}" class="btn-tambah">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Cipta Pemberitahuan
            </a>
        </div>

        <div class="table-card">
            @if ($announcements->isEmpty())
                <div class="empty-msg">Tiada pemberitahuan buat masa ini.</div>
            @else
                <div class="ann-list">
                    @foreach ($announcements as $a)
                        <div class="ann-item">
                            <div class="ann-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                            </div>
                            <div class="ann-body">
                                <div class="ann-title">{{ $a->title }}</div>
                                <div class="ann-preview">{{ $a->preview }}</div>
                                <div class="ann-meta">
                                    <span>{{ \Carbon\Carbon::parse($a->created_at)->timezone('Asia/Kuala_Lumpur')->locale('ms')->isoFormat('D MMM YYYY') }}</span>
                                    @if ($a->creator)
                                        <span>•</span>
                                        <span>Oleh: {{ $a->creator->name }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="ann-actions">
                                <a href="{{ route('pemberitahuan.edit', ['pemberitahuan' => $a]) }}" class="btn-icon" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form method="POST" action="{{ route('pemberitahuan.destroy', ['pemberitahuan' => $a]) }}" style="display:inline;" onsubmit="return confirm('Padam pemberitahuan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-icon delete" title="Padam">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($announcements->hasPages())
                    <div class="pagination">
                        <span class="pag-info">Memaparkan {{ $announcements->firstItem() }} hingga {{ $announcements->lastItem() }} daripada {{ $announcements->total() }} pemberitahuan</span>
                        <div class="pag-pages">
                            @if (! $announcements->onFirstPage())
                                <a href="{{ $announcements->previousPageUrl() }}" class="pag-btn"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg></a>
                            @endif
                            @foreach ($announcements->getUrlRange(1, $announcements->lastPage()) as $page => $url)
                                <a href="{{ $url }}" class="pag-btn {{ $page == $announcements->currentPage() ? 'active' : '' }}">{{ $page }}</a>
                            @endforeach
                            @if ($announcements->hasMorePages())
                                <a href="{{ $announcements->nextPageUrl() }}" class="pag-btn"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg></a>
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
