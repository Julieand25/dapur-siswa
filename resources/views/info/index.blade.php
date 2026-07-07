<x-admin-layout active="info" title="Info Projek" subtitle="Maklumat projek Dapur Siswa Madani UPSI">

    @push('styles')
    <style>
        .content {
            padding: 28px;
            flex: 1;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
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

        .info-item {
            display: flex;
            gap: 10px;
            padding: 8px 0;
            font-size: 13px;
            color: #374151;
            align-items: flex-start;
        }

        .info-item .dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #1a56db;
            margin-top: 7px;
            flex-shrink: 0;
        }

        .info-item .text {
            line-height: 1.6;
        }

        .info-item .text strong {
            font-weight: 700;
            color: #111827;
        }

        .info-text {
            font-size: 13px;
            color: #374151;
            line-height: 1.8;
        }

        .team-member {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .team-member:last-child {
            border-bottom: none;
        }

        .team-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #1a56db;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .team-info .team-name {
            font-size: 13px;
            font-weight: 600;
            color: #111827;
        }

        .team-info .team-matric {
            font-size: 12px;
            color: #6b7280;
            margin-top: 2px;
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

        .supervisor-name {
            font-size: 13px;
            font-weight: 600;
            color: #111827;
        }

        .subject-code {
            font-size: 12px;
            font-weight: 600;
            color: #1a56db;
            display: inline-block;
            min-width: 90px;
        }

        @media (max-width: 768px) {
            .info-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 640px) {
            .content { padding: 16px; }
            .card { padding: 20px; }
        }
    </style>
    @endpush

    <main class="content">
        <div class="info-grid">

            <div class="card">
                <div class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    Subject
                </div>
                <div class="info-item">
                    <div class="dot"></div>
                    <div class="text"><span class="subject-code">DTD3053</span> Web Programming for Information Systems</div>
                </div>
                <div class="info-item">
                    <div class="dot"></div>
                    <div class="text"><span class="subject-code">DTS3073</span> Mobile Application Design and Development</div>
                </div>
                <div class="info-item">
                    <div class="dot"></div>
                    <div class="text"><span class="subject-code">DTB3013</span> Digital Entrepreneurship</div>
                </div>
            </div>

            <div class="card">
                <div class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    Supervisor
                </div>
                <div class="info-item">
                    <div class="dot"></div>
                    <div class="text supervisor-name">Associate Professor Dr. Aslina Binti Saad</div>
                </div>
                <div class="info-item">
                    <div class="dot"></div>
                    <div class="text supervisor-name">Encik Rasyidi Bin Johan</div>
                </div>
                <div class="info-item">
                    <div class="dot"></div>
                    <div class="text supervisor-name">Dr. Norhisham Bin Mohamad Nordin</div>
                </div>
            </div>

            <div class="card full">
                <div class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Project Objective
                </div>
                <div class="info-text">
                    The objective of the Dapur Siswa MADANI Booking System is to provide a simple and efficient platform for students to book kitchen facilities while helping administrators manage bookings, equipment, and inventory more systematically. The system aims to reduce booking conflicts and improve overall kitchen management through organized scheduling and real-time updates.
                </div>
            </div>

            <div class="card full">
                <div class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/></svg>
                    Project Team
                </div>
                <div class="team-member">
                    <div class="team-avatar">NS</div>
                    <div class="team-info">
                        <div class="team-name">NUR SYAFIQAH SYAZWANI BINTI MOHD SARIFUDIN</div>
                        <div class="team-matric">D20231106483</div>
                    </div>
                </div>
                <div class="team-member">
                    <div class="team-avatar">NF</div>
                    <div class="team-info">
                        <div class="team-name">NUR FARRAH ATIQAH BINTI FAIZAL</div>
                        <div class="team-matric">D20231106479</div>
                    </div>
                </div>
                <div class="team-member">
                    <div class="team-avatar">NI</div>
                    <div class="team-info">
                        <div class="team-name">NUR FATIN IZUANI BINTI MOHD JOHARI</div>
                        <div class="team-matric">D20231106458</div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <footer class="footer">
        &copy; 2024 Dapur Siswa Madani UPSI. Hak Cipta Terpelihara.
    </footer>

</x-admin-layout>
