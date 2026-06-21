<?php

namespace Database\Seeders;

use App\Models\Dapur;
use Illuminate\Database\Seeder;

class DapurSeeder extends Seeder
{
    public function run(): void
    {
        $dapurs = [
            ['lokasi' => 'KHAR', 'nama_dapur' => 'Dapur 1', 'status' => 'tersedia', 'max_orang' => 10,
                'peralatans' => [
                    ['nama' => 'Periuk Besar', 'kuantiti' => 5, 'status' => 'Tersedia'],
                    ['nama' => 'Kuali Leper', 'kuantiti' => 8, 'status' => 'Tersedia'],
                    ['nama' => 'Pisau Chef', 'kuantiti' => 12, 'status' => 'Tersedia'],
                    ['nama' => 'Papan Pemotong', 'kuantiti' => 10, 'status' => 'Rosak'],
                    ['nama' => 'Ketuhar Elektrik', 'kuantiti' => 2, 'status' => 'Diselenggara'],
                ],
                'bahans' => [
                    ['nama' => 'Minyak Masak', 'kuantiti' => 5, 'unit' => 'Botol'],
                    ['nama' => 'Beras', 'kuantiti' => 10, 'unit' => 'Kg'],
                    ['nama' => 'Garam', 'kuantiti' => 3, 'unit' => 'Pek'],
                    ['nama' => 'Gula Pasir', 'kuantiti' => 4, 'unit' => 'Kg'],
                ],
            ],
            ['lokasi' => 'KHAR', 'nama_dapur' => 'Dapur 2', 'status' => 'tersedia', 'max_orang' => 8,
                'peralatans' => [
                    ['nama' => 'Periuk Besar', 'kuantiti' => 3, 'status' => 'Tersedia'],
                    ['nama' => 'Kuali Leper', 'kuantiti' => 6, 'status' => 'Tersedia'],
                    ['nama' => 'Pisau Chef', 'kuantiti' => 10, 'status' => 'Tersedia'],
                    ['nama' => 'Papan Pemotong', 'kuantiti' => 8, 'status' => 'Tersedia'],
                    ['nama' => 'Ketuhar Elektrik', 'kuantiti' => 1, 'status' => 'Rosak'],
                ],
                'bahans' => [
                    ['nama' => 'Minyak Masak', 'kuantiti' => 3, 'unit' => 'Botol'],
                    ['nama' => 'Beras', 'kuantiti' => 8, 'unit' => 'Kg'],
                    ['nama' => 'Garam', 'kuantiti' => 2, 'unit' => 'Pek'],
                    ['nama' => 'Gula Pasir', 'kuantiti' => 3, 'unit' => 'Kg'],
                ],
            ],
            ['lokasi' => 'KUO', 'nama_dapur' => 'Dapur 1', 'status' => 'tidak-tersedia', 'max_orang' => 12,
                'peralatans' => [
                    ['nama' => 'Periuk Besar', 'kuantiti' => 4, 'status' => 'Tersedia'],
                    ['nama' => 'Kuali Leper', 'kuantiti' => 7, 'status' => 'Tersedia'],
                    ['nama' => 'Pisau Chef', 'kuantiti' => 15, 'status' => 'Tersedia'],
                    ['nama' => 'Papan Pemotong', 'kuantiti' => 12, 'status' => 'Diselenggara'],
                    ['nama' => 'Pengisar', 'kuantiti' => 3, 'status' => 'Tersedia'],
                ],
                'bahans' => [
                    ['nama' => 'Minyak Masak', 'kuantiti' => 6, 'unit' => 'Botol'],
                    ['nama' => 'Beras', 'kuantiti' => 15, 'unit' => 'Kg'],
                    ['nama' => 'Garam', 'kuantiti' => 5, 'unit' => 'Pek'],
                    ['nama' => 'Sos Tiram', 'kuantiti' => 4, 'unit' => 'Botol'],
                ],
            ],
            ['lokasi' => 'KAHS', 'nama_dapur' => 'Dapur 1', 'status' => 'tersedia', 'max_orang' => 10,
                'peralatans' => [
                    ['nama' => 'Periuk Besar', 'kuantiti' => 5, 'status' => 'Tersedia'],
                    ['nama' => 'Kuali Leper', 'kuantiti' => 8, 'status' => 'Tersedia'],
                    ['nama' => 'Pisau Chef', 'kuantiti' => 12, 'status' => 'Tersedia'],
                    ['nama' => 'Papan Pemotong', 'kuantiti' => 10, 'status' => 'Tersedia'],
                    ['nama' => 'Ketuhar Elektrik', 'kuantiti' => 2, 'status' => 'Tersedia'],
                ],
                'bahans' => [
                    ['nama' => 'Minyak Masak', 'kuantiti' => 4, 'unit' => 'Botol'],
                    ['nama' => 'Beras', 'kuantiti' => 12, 'unit' => 'Kg'],
                    ['nama' => 'Garam', 'kuantiti' => 4, 'unit' => 'Pek'],
                    ['nama' => 'Tepung Gandum', 'kuantiti' => 5, 'unit' => 'Kg'],
                ],
            ],
            ['lokasi' => 'KAB', 'nama_dapur' => 'Dapur 1', 'status' => 'tersedia', 'max_orang' => 6,
                'peralatans' => [
                    ['nama' => 'Periuk Kecil', 'kuantiti' => 4, 'status' => 'Tersedia'],
                    ['nama' => 'Kuali Leper', 'kuantiti' => 5, 'status' => 'Tersedia'],
                    ['nama' => 'Pisau Chef', 'kuantiti' => 6, 'status' => 'Tersedia'],
                    ['nama' => 'Papan Pemotong', 'kuantiti' => 5, 'status' => 'Tersedia'],
                    ['nama' => 'Periuk Nasi', 'kuantiti' => 2, 'status' => 'Diselenggara'],
                ],
                'bahans' => [
                    ['nama' => 'Minyak Masak', 'kuantiti' => 2, 'unit' => 'Botol'],
                    ['nama' => 'Beras', 'kuantiti' => 5, 'unit' => 'Kg'],
                    ['nama' => 'Garam', 'kuantiti' => 1, 'unit' => 'Pek'],
                    ['nama' => 'Serbuk Kari', 'kuantiti' => 3, 'unit' => 'Pek'],
                ],
            ],
            ['lokasi' => 'KZ', 'nama_dapur' => 'Dapur 1', 'status' => 'tidak-tersedia', 'max_orang' => 8,
                'peralatans' => [
                    ['nama' => 'Periuk Besar', 'kuantiti' => 2, 'status' => 'Rosak'],
                    ['nama' => 'Kuali Leper', 'kuantiti' => 3, 'status' => 'Tersedia'],
                    ['nama' => 'Pisau Chef', 'kuantiti' => 4, 'status' => 'Tersedia'],
                    ['nama' => 'Papan Pemotong', 'kuantiti' => 3, 'status' => 'Tersedia'],
                    ['nama' => 'Pengukus', 'kuantiti' => 1, 'status' => 'Rosak'],
                ],
                'bahans' => [
                    ['nama' => 'Minyak Masak', 'kuantiti' => 1, 'unit' => 'Botol'],
                    ['nama' => 'Beras', 'kuantiti' => 3, 'unit' => 'Kg'],
                    ['nama' => 'Garam', 'kuantiti' => 1, 'unit' => 'Pek'],
                    ['nama' => 'Lada Hitam', 'kuantiti' => 2, 'unit' => 'Pek'],
                ],
            ],
        ];

        foreach ($dapurs as $data) {
            $dapur = Dapur::create([
                'lokasi' => $data['lokasi'],
                'nama_dapur' => $data['nama_dapur'],
                'status' => $data['status'],
                'max_orang' => $data['max_orang'],
            ]);

            foreach ($data['peralatans'] as $p) {
                $dapur->peralatans()->create($p);
            }

            foreach ($data['bahans'] as $b) {
                $dapur->bahans()->create($b);
            }
        }
    }
}
