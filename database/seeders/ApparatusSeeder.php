<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Apparatus;

class ApparatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apparatusList = [
            [
                'name' => 'Ir. H. Budi Santoso',
                'role' => 'Kepala Desa (Kades)',
                'icon' => 'fa-user-tie',
                'desc' => 'Memimpin Desa Makmur Sentosa sejak 2018 dengan fokus inovasi layanan digital warga.',
                'facebook' => '#',
                'instagram' => '#',
                'email' => 'budi@makmursentosa.desa.id'
            ],
            [
                'name' => 'Siti Rahmawati, S.E.',
                'role' => 'Sekretaris Desa (Sekdes)',
                'icon' => 'fa-user-pen',
                'desc' => 'Bertanggung jawab atas administrasi umum, kearsipan, dan efisiensi birokrasi desa.',
                'facebook' => '#',
                'instagram' => '#',
                'email' => 'siti@makmursentosa.desa.id'
            ],
            [
                'name' => 'Ahmad Fauzi, A.Md.',
                'role' => 'Bendahara Desa',
                'icon' => 'fa-file-invoice-dollar',
                'desc' => 'Mengelola keuangan desa dengan transparan, akuntabel, dan terintegrasi digital.',
                'facebook' => '#',
                'instagram' => '#',
                'email' => 'ahmad@makmursentosa.desa.id'
            ],
            [
                'name' => 'Dewi Lestari',
                'role' => 'Kasi Pelayanan & Kesejahteraan',
                'icon' => 'fa-handshake-angle',
                'desc' => 'Melayani perizinan, pengurusan surat warga, dan mengelola program jaminan sosial.',
                'facebook' => '#',
                'instagram' => '#',
                'email' => 'dewi@makmursentosa.desa.id'
            ]
        ];

        foreach ($apparatusList as $data) {
            Apparatus::create($data);
        }
    }
}
