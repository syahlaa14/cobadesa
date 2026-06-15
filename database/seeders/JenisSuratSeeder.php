<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisSurat;

class JenisSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisSurat = [
            [
                'nama_surat' => 'Surat Keterangan Usaha',
                'kode_surat' => 'sku',
                'keterangan' => 'Layanan pengajuan draf surat keterangan usaha (SKU) mandiri online.',
                'aktif' => true,
            ],
            [
                'nama_surat' => 'Surat Keterangan Tidak Mampu',
                'kode_surat' => 'sktm',
                'keterangan' => 'Layanan pengajuan draf surat keterangan tidak mampu (SKTM) mandiri online.',
                'aktif' => true,
            ],
            [
                'nama_surat' => 'Surat Pengantar Umum',
                'kode_surat' => 'sp',
                'keterangan' => 'Layanan pengajuan draf surat pengantar domisili/KTP mandiri online.',
                'aktif' => true,
            ],
        ];

        foreach ($jenisSurat as $item) {
            JenisSurat::create($item);
        }
    }
}
