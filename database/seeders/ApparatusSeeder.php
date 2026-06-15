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
                'nama' => 'Muhamad Samsi',
                'jabatan' => 'Kepala Desa (Kades)',
                'foto' => 'uploads/apparatus/muhamad_samsi.jpg',
                'keterangan_jabatan' => 'Memimpin jalannya roda pemerintahan dan pembangunan Desa Pasir Kulon dengan amanah.',
                'facebook' => '#',
                'instagram' => '#',
                'email' => 'samsi@pasirkulon.desa.id',
                'nip' => '-',
                'sk_pengangkatan' => '141/05/DS/2021',
                'tanggal_sk' => '2021-05-10',
                'status_aktif' => true,
            ],
            [
                'nama' => 'Edi Mulyono',
                'jabatan' => 'Sekretaris Desa (Sekdes)',
                'foto' => 'uploads/apparatus/edi_mulyono.jpg',
                'keterangan_jabatan' => 'Bertanggung jawab atas administrasi umum, pelayanan data, dan operasional kantor desa.',
                'facebook' => '#',
                'instagram' => '#',
                'email' => 'edi@pasirkulon.desa.id',
                'nip' => '197508202010011002',
                'sk_pengangkatan' => '141/12/DS/2020',
                'tanggal_sk' => '2020-12-15',
                'status_aktif' => true,
            ],
            [
                'nama' => 'Yuliana Puspa Dewi',
                'jabatan' => 'Kaur Perencanaan',
                'foto' => 'uploads/apparatus/yuliana_puspa_dewi.jpg',
                'keterangan_jabatan' => 'Menyusun rencana pembangunan desa, anggaran tahunan, dan evaluasi capaian kinerja.',
                'facebook' => '#',
                'instagram' => '#',
                'email' => 'yuliana@pasirkulon.desa.id',
                'nip' => '-',
                'sk_pengangkatan' => '141/02/DS/2021',
                'tanggal_sk' => '2021-02-18',
                'status_aktif' => true,
            ],
            [
                'nama' => 'Siti Aminah',
                'jabatan' => 'Kaur Keuangan',
                'foto' => 'uploads/apparatus/siti_aminah.jpg',
                'keterangan_jabatan' => 'Mengelola keuangan desa secara transparan, mencakup pembukuan dan penyusunan laporan keuangan.',
                'facebook' => '#',
                'instagram' => '#',
                'email' => 'siti@pasirkulon.desa.id',
                'nip' => '-',
                'sk_pengangkatan' => '141/03/DS/2021',
                'tanggal_sk' => '2021-03-20',
                'status_aktif' => true,
            ],
            [
                'nama' => 'Suprapti',
                'jabatan' => 'Kaur TU & Umum',
                'foto' => 'uploads/apparatus/suprapti.jpg',
                'keterangan_jabatan' => 'Mengatur administrasi tata usaha, korespondensi surat menyurat, dan perlengkapan inventaris kantor.',
                'facebook' => '#',
                'instagram' => '#',
                'email' => 'suprapti@pasirkulon.desa.id',
                'nip' => '-',
                'sk_pengangkatan' => '141/04/DS/2021',
                'tanggal_sk' => '2021-04-10',
                'status_aktif' => true,
            ],
            [
                'nama' => 'Sachirun',
                'jabatan' => 'Kepala Dusun I (Kadus I)',
                'foto' => 'uploads/apparatus/sachirun.jpg',
                'keterangan_jabatan' => 'Melakukan pembinaan wilayah dusun I mencakup ketertiban, kebersihan, dan kerukunan warga.',
                'facebook' => '#',
                'instagram' => '#',
                'email' => 'sachirun@pasirkulon.desa.id',
                'nip' => '-',
                'sk_pengangkatan' => '141/06/DS/2021',
                'tanggal_sk' => '2021-06-05',
                'status_aktif' => true,
            ],
            [
                'nama' => 'Mei Nur Khasanah',
                'jabatan' => 'Kepala Dusun II (Kadus II)',
                'foto' => 'uploads/apparatus/mei_nur_khasanah.jpg',
                'keterangan_jabatan' => 'Mengoordinasikan urusan kemasyarakatan dan pembangunan infrastruktur di wilayah dusun II.',
                'facebook' => '#',
                'instagram' => '#',
                'email' => 'meinur@pasirkulon.desa.id',
                'nip' => '-',
                'sk_pengangkatan' => '141/07/DS/2021',
                'tanggal_sk' => '2021-06-05',
                'status_aktif' => true,
            ],
            [
                'nama' => 'Mualif',
                'jabatan' => 'Kasi Pemerintahan',
                'foto' => 'uploads/apparatus/mualif.jpg',
                'keterangan_jabatan' => 'Mengelola administrasi kependudukan, pembinaan keamanan dan ketertiban umum wilayah desa.',
                'facebook' => '#',
                'instagram' => '#',
                'email' => 'mualif@pasirkulon.desa.id',
                'nip' => '-',
                'sk_pengangkatan' => '141/08/DS/2021',
                'tanggal_sk' => '2021-08-01',
                'status_aktif' => true,
            ],
            [
                'nama' => 'Imam Buchori',
                'jabatan' => 'Kasi Kesra',
                'foto' => 'uploads/apparatus/imam_buchori.jpg',
                'keterangan_jabatan' => 'Mengelola pelayanan sosial keagamaan, bantuan kemasyarakatan, dan program kesejahteraan warga.',
                'facebook' => '#',
                'instagram' => '#',
                'email' => 'imam@pasirkulon.desa.id',
                'nip' => '-',
                'sk_pengangkatan' => '141/09/DS/2021',
                'tanggal_sk' => '2021-08-15',
                'status_aktif' => true,
            ],
            [
                'nama' => 'Wawan Riyanto',
                'jabatan' => 'Kasi Pelayanan',
                'foto' => 'uploads/apparatus/wawan_riyanto.jpg',
                'keterangan_jabatan' => 'Melayani pengurusan berkas administrasi nikah, kematian, dan jaminan kesehatan warga.',
                'facebook' => '#',
                'instagram' => '#',
                'email' => 'wawan@pasirkulon.desa.id',
                'nip' => '-',
                'sk_pengangkatan' => '141/10/DS/2021',
                'tanggal_sk' => '2021-09-01',
                'status_aktif' => true,
            ]
        ];

        foreach ($apparatusList as $data) {
            Apparatus::create($data);
        }
    }
}
