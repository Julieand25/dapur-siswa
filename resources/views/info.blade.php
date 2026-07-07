<x-admin-layout active="info" title="Maklumat Projek" subtitle="Dapur Siswa Madani Booking System">

    @push('styles')
    <style>
        .content { padding: 28px; flex: 1; }

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
            margin-bottom: 14px;
        }

        .info-item:last-child { margin-bottom: 0; }

        .info-label {
            font-size: 11.5px;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 4px;
        }

        .info-value {
            font-size: 13.5px;
            color: #374151;
            font-weight: 500;
        }

        .team-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 16px;
            margin-top: 4px;
        }

        .team-member {
            background: #f9fafb;
            border-radius: 8px;
            padding: 16px;
            text-align: center;
        }

        .team-name {
            font-size: 13px;
            font-weight: 600;
            color: #111827;
            line-height: 1.4;
        }

        .team-matrik {
            font-size: 11.5px;
            color: #6b7280;
            margin-top: 4px;
        }

        .obj-text {
            font-size: 13.5px;
            color: #374151;
            line-height: 1.7;
            font-weight: 500;
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

        @media (max-width: 900px) {
            .info-grid { grid-template-columns: 1fr; }
            .team-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 640px) {
            .content { padding: 16px; }
        }
    </style>
    @endpush

    <main class="content">

        <div class="info-grid">

            <div class="card">
                <div class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 14l9-5-9-5-9 5 9 5z"/><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                    Subject
                </div>
                <div class="info-item">
                    <div class="info-value">DTD3053 - Web Programming for Information Systems</div>
                </div>
                <div class="info-item">
                    <div class="info-value">DTS3073 - Mobile Application Design and Development</div>
                </div>
                <div class="info-item">
                    <div class="info-value">DTB3013 - Digital Entrepreneurship</div>
                </div>
            </div>

            <div class="card">
                <div class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
                    Supervisor
                </div>
                <div class="info-item">
                    <div class="info-value">Associate Professor Dr. Aslina Binti Saad</div>
                </div>
                <div class="info-item">
                    <div class="info-value">Encik Rasyidi Bin Johan</div>
                </div>
                <div class="info-item">
                    <div class="info-value">Dr. Norhisham Bin Mohamad Nordin</div>
                </div>
            </div>

            <div class="card full">
                <div class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Project Objective
                </div>
                <p class="obj-text">
                    The objective of the Dapur Siswa MADANI Booking System is to provide a simple and efficient platform for students to book kitchen facilities while helping administrators manage bookings, equipment, and inventory more systematically. The system aims to reduce booking conflicts and improve overall kitchen management through organized scheduling and real-time updates.
                </p>
            </div>

            <div class="card full">
                <div class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Project Team
                </div>
                <div class="team-grid">
                    <div class="team-member">
                        <div class="team-name">NUR SYAFIQAH SYAZWANI BINTI MOHD SARIFUDIN</div>
                        <div class="team-matrik">D20231106483</div>
                    </div>
                    <div class="team-member">
                        <div class="team-name">NUR FARRAH ATIQAH BINTI FAIZAL</div>
                        <div class="team-matrik">D20231106479</div>
                    </div>
                    <div class="team-member">
                        <div class="team-name">NUR FATIN IZUANI BINTI MOHD JOHARI</div>
                        <div class="team-matrik">D20231106458</div>
                    </div>
                </div>
            </div>

        </div>

    </main>

    <footer class="footer">
        &copy; 2024 Dapur Siswa Madani UPSI. Hak Cipta Terpelihara.
    </footer>

</x-admin-layout>
