<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default admin user
        $admin = User::factory()->create([
            'name' => 'Admin Desa',
            'email' => 'admin@desa.go.id',
            'password' => Hash::make('admin123'),
        ]);

        $this->call([
            ApparatusSeeder::class,
            TourismSeeder::class,
            JenisSuratSeeder::class,
            PendudukSeeder::class,
        ]);

        // Seed Kategori Berita
        $kategoriPengumuman = \App\Models\KategoriBerita::create([
            'nama' => 'Pengumuman',
            'slug' => 'pengumuman'
        ]);

        $kategoriKegiatan = \App\Models\KategoriBerita::create([
            'nama' => 'Kegiatan Desa',
            'slug' => 'kegiatan-desa'
        ]);

        $kategoriPembangunan = \App\Models\KategoriBerita::create([
            'nama' => 'Pembangunan',
            'slug' => 'pembangunan'
        ]);

        // Seed Berita
        \App\Models\Berita::create([
            'user_id' => $admin->id,
            'kategori_id' => $kategoriPengumuman->id,
            'judul' => 'Penyaluran Bantuan Langsung Tunai (BLT) Tahap II',
            'slug' => 'penyaluran-bantuan-langsung-tunai-blt-tahap-ii',
            'konten' => 'Pemerintah Desa Pasir Kulon kembali menyalurkan Bantuan Langsung Tunai (BLT) Dana Desa Tahap II kepada warga yang berhak menerima. Penyaluran ini bertempat di aula kantor desa dengan tertib dan lancar.',
            'gambar' => 'uploads/news/blt.png',
            'status' => 'published'
        ]);

        \App\Models\Berita::create([
            'user_id' => $admin->id,
            'kategori_id' => $kategoriKegiatan->id,
            'judul' => 'Kerja Bakti Massal Pembersihan Saluran Irigasi',
            'slug' => 'kerja-bakti-massal-pembersihan-saluran-irigasi',
            'konten' => 'Warga Desa Pasir Kulon bergotong-royong melaksanakan kerja bakti pembersihan saluran air irigasi pertanian. Hal ini dilakukan untuk mempersiapkan musim tanam padi agar pasokan air mengalir dengan optimal.',
            'gambar' => 'uploads/news/kerja_bakti.png',
            'status' => 'published'
        ]);

        \App\Models\Berita::create([
            'user_id' => $admin->id,
            'kategori_id' => $kategoriPembangunan->id,
            'judul' => 'Pembangunan Aspal Jalan Usaha Tani RT 03',
            'slug' => 'pembangunan-aspal-jalan-usaha-tani-rt-03',
            'konten' => 'Realisasi pembangunan infrastruktur jalan usaha tani di wilayah RT 03 RW 02 telah selesai dilaksanakan. Pembangunan jalan ini diharapkan mempermudah mobilitas petani mengangkut hasil panen padi.',
            'gambar' => 'uploads/news/jalan.png',
            'status' => 'published'
        ]);

        // Seed Kegiatan / Event
        \App\Models\Kegiatan::create([
            'judul' => 'Posyandu Lansia & Balita Serentak',
            'slug' => 'posyandu-lansia-balita-serentak',
            'deskripsi' => 'Pemeriksaan kesehatan gratis rutin bulanan untuk lansia dan balita di balai kesehatan desa.',
            'tanggal_mulai' => '2026-06-20',
            'tanggal_selesai' => '2026-06-20',
            'lokasi' => 'PKD / Balai Kesehatan Desa',
            'status' => 'rencana'
        ]);

        \App\Models\Kegiatan::create([
            'judul' => 'Musyawarah Perencanaan Pembangunan Desa (Musrenbangdes)',
            'slug' => 'musrenbangdes',
            'deskripsi' => 'Rapat koordinasi penyusunan rancangan rencana pembangunan jangka menengah desa bersama BPD dan tokoh masyarakat.',
            'tanggal_mulai' => '2026-06-25',
            'tanggal_selesai' => '2026-06-25',
            'lokasi' => 'Aula Pertemuan Pasir Kulon',
            'status' => 'rencana'
        ]);

        \App\Models\Kegiatan::create([
            'judul' => 'Pelatihan Sablon & Desain Grafis UMKM',
            'slug' => 'pelatihan-sablon-desain-grafis-umkm',
            'deskripsi' => 'Pelatihan peningkatan keterampilan usaha sablon dan desain grafis untuk pemuda desa karang taruna.',
            'tanggal_mulai' => '2026-06-12',
            'tanggal_selesai' => '2026-06-14',
            'lokasi' => 'Balai Desa Pasir Kulon',
            'status' => 'selesai'
        ]);
    }
}
