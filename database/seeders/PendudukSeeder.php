<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penduduk;
use App\Models\AnggotaKeluarga;

class PendudukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Kepala Desa: Muhamad Samsi
        $kades = Penduduk::create([
            'nik' => '3204123456780001',
            'nama_lengkap' => 'Muhamad Samsi',
            'tempat_lahir' => 'Banyumas',
            'tanggal_lahir' => '1970-04-12',
            'jenis_kelamin' => 'L',
            'agama' => 'Islam',
            'status_perkawinan' => 'Kawin',
            'pekerjaan' => 'Kepala Desa',
            'pendidikan' => 'S1 Ilmu Pemerintahan',
            'alamat' => 'Pasir Kulon RT 01 RW 01',
            'rt' => '01',
            'rw' => '01',
        ]);

        // Anggota Keluarga Kades
        AnggotaKeluarga::create([
            'penduduk_id' => $kades->id,
            'nik_anggota' => '3204123456780011',
            'nama_anggota' => 'Halimah',
            'hubungan' => 'Istri',
            'status' => 'Aktif',
        ]);

        // 2. Sekdes: Edi Mulyono
        Penduduk::create([
            'nik' => '3204123456780002',
            'nama_lengkap' => 'Edi Mulyono',
            'tempat_lahir' => 'Banyumas',
            'tanggal_lahir' => '1975-08-20',
            'jenis_kelamin' => 'L',
            'agama' => 'Islam',
            'status_perkawinan' => 'Kawin',
            'pekerjaan' => 'PNS / Sekretaris Desa',
            'pendidikan' => 'S1 Administrasi Publik',
            'alamat' => 'Pasir Kulon RT 02 RW 01',
            'rt' => '02',
            'rw' => '01',
        ]);

        // 3. Kaur Perencanaan: Yuliana Puspa Dewi
        Penduduk::create([
            'nik' => '3204123456780003',
            'nama_lengkap' => 'Yuliana Puspa Dewi',
            'tempat_lahir' => 'Banyumas',
            'tanggal_lahir' => '1982-11-05',
            'jenis_kelamin' => 'P',
            'agama' => 'Islam',
            'status_perkawinan' => 'Kawin',
            'pekerjaan' => 'Kaur Perencanaan',
            'pendidikan' => 'S1 Ekonomi',
            'alamat' => 'Pasir Kulon RT 01 RW 03',
            'rt' => '01',
            'rw' => '03',
        ]);

        // 4. Kaur Keuangan: Siti Aminah
        Penduduk::create([
            'nik' => '3204123456780004',
            'nama_lengkap' => 'Siti Aminah',
            'tempat_lahir' => 'Banyumas',
            'tanggal_lahir' => '1985-03-14',
            'jenis_kelamin' => 'P',
            'agama' => 'Islam',
            'status_perkawinan' => 'Kawin',
            'pekerjaan' => 'Kaur Keuangan',
            'pendidikan' => 'D3 Akuntansi',
            'alamat' => 'Pasir Kulon RT 02 RW 02',
            'rt' => '02',
            'rw' => '02',
        ]);

        // 5. Kaur TU & Umum: Suprapti
        Penduduk::create([
            'nik' => '3204123456780005',
            'nama_lengkap' => 'Suprapti',
            'tempat_lahir' => 'Banyumas',
            'tanggal_lahir' => '1980-05-18',
            'jenis_kelamin' => 'P',
            'agama' => 'Islam',
            'status_perkawinan' => 'Kawin',
            'pekerjaan' => 'Kaur TU & Umum',
            'pendidikan' => 'SMA',
            'alamat' => 'Pasir Kulon RT 03 RW 02',
            'rt' => '03',
            'rw' => '02',
        ]);

        // 6. Kadus I: Sachirun
        Penduduk::create([
            'nik' => '3204123456780006',
            'nama_lengkap' => 'Sachirun',
            'tempat_lahir' => 'Banyumas',
            'tanggal_lahir' => '1972-06-15',
            'jenis_kelamin' => 'L',
            'agama' => 'Islam',
            'status_perkawinan' => 'Kawin',
            'pekerjaan' => 'Kepala Dusun',
            'pendidikan' => 'SMA',
            'alamat' => 'Pasir Kulon RT 02 RW 04',
            'rt' => '02',
            'rw' => '04',
        ]);

        // 7. Kadus II: Mei Nur Khasanah
        Penduduk::create([
            'nik' => '3204123456780007',
            'nama_lengkap' => 'Mei Nur Khasanah',
            'tempat_lahir' => 'Banyumas',
            'tanggal_lahir' => '1988-05-01',
            'jenis_kelamin' => 'P',
            'agama' => 'Islam',
            'status_perkawinan' => 'Kawin',
            'pekerjaan' => 'Kepala Dusun',
            'pendidikan' => 'D3 Keperawatan',
            'alamat' => 'Pasir Kulon RT 03 RW 04',
            'rt' => '03',
            'rw' => '04',
        ]);

        // 8. Kasi Pemerintahan: Mualif
        Penduduk::create([
            'nik' => '3204123456780008',
            'nama_lengkap' => 'Mualif',
            'tempat_lahir' => 'Banyumas',
            'tanggal_lahir' => '1979-09-08',
            'jenis_kelamin' => 'L',
            'agama' => 'Islam',
            'status_perkawinan' => 'Kawin',
            'pekerjaan' => 'Kasi Pemerintahan',
            'pendidikan' => 'S1 Hukum',
            'alamat' => 'Pasir Kulon RT 02 RW 05',
            'rt' => '02',
            'rw' => '05',
        ]);

        // 9. Kasi Kesra: Imam Buchori
        Penduduk::create([
            'nik' => '3204123456780009',
            'nama_lengkap' => 'Imam Buchori',
            'tempat_lahir' => 'Banyumas',
            'tanggal_lahir' => '1981-12-25',
            'jenis_kelamin' => 'L',
            'agama' => 'Islam',
            'status_perkawinan' => 'Kawin',
            'pekerjaan' => 'Kasi Kesejahteraan Rakyat',
            'pendidikan' => 'S1 Pendidikan Agama',
            'alamat' => 'Pasir Kulon RT 01 RW 03',
            'rt' => '01',
            'rw' => '03',
        ]);

        // 10. Kasi Pelayanan: Wawan Riyanto
        Penduduk::create([
            'nik' => '3204123456780010',
            'nama_lengkap' => 'Wawan Riyanto',
            'tempat_lahir' => 'Banyumas',
            'tanggal_lahir' => '1986-07-30',
            'jenis_kelamin' => 'L',
            'agama' => 'Islam',
            'status_perkawinan' => 'Kawin',
            'pekerjaan' => 'Kasi Pelayanan',
            'pendidikan' => 'SMA',
            'alamat' => 'Pasir Kulon RT 03 RW 03',
            'rt' => '03',
            'rw' => '03',
        ]);
    }
}
