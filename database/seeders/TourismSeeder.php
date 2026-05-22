<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tourism;

class TourismSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tourismList = [
            [
                'title' => 'Lembah Sawah Hijau',
                'category' => 'nature',
                'category_label' => 'Wisata Alam',
                'icon' => 'fa-tree',
                'desc' => 'Terasering persawahan hijau membentang luas dengan jalur treking sepeda yang asri dan udara pagi berkabut tipis.'
            ],
            [
                'title' => 'Sanggar Tari Wijayakusuma',
                'category' => 'culture',
                'category_label' => 'Seni & Budaya',
                'icon' => 'fa-masks-theater',
                'desc' => 'Seni pertunjukan tari daerah warisan leluhur yang diajarkan secara turun-temurun kepada pemuda desa setiap pekan.'
            ],
            [
                'title' => 'Madu Hutan & Kopi Lereng',
                'category' => 'culinary',
                'category_label' => 'Kuliner Khas',
                'icon' => 'fa-jar',
                'desc' => 'Hasil bumi kopi organik arabika pilihan dipadukan dengan madu liar murni hasil penangkaran ramah lingkungan warga.'
            ],
            [
                'title' => 'Curug Kembar Pelangi',
                'category' => 'nature',
                'category_label' => 'Wisata Alam',
                'icon' => 'fa-water',
                'desc' => 'Air terjun alami tersembunyi dengan kolam renang alami sebening kaca yang memancarkan pelangi indah di siang hari.'
            ],
            [
                'title' => 'Gelar Budaya Seren Taun',
                'category' => 'culture',
                'category_label' => 'Seni & Budaya',
                'icon' => 'fa-guitar',
                'desc' => 'Upacara adat tahunan sebagai ungkapan syukur atas limpahan panen, dipenuhi pertunjukan musik bambu tradisional.'
            ],
            [
                'title' => 'Olahan Jamur & Ubi Legit',
                'category' => 'culinary',
                'category_label' => 'Kuliner Khas',
                'icon' => 'fa-bowl-food',
                'desc' => 'Camilan keripik sehat berbahan baku jamur tiram dan ubi ungu yang diproduksi terintegrasi oleh kelompok wanita tani.'
            ]
        ];

        foreach ($tourismList as $data) {
            Tourism::create($data);
        }
    }
}
