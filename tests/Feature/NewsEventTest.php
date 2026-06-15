<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\KategoriBerita;
use App\Models\Berita;
use App\Models\Kegiatan;

class NewsEventTest extends TestCase
{
    use RefreshDatabase;

    protected $adminUser;

    protected function setUp(): void
    {
        parent::setUp();

        // Create default admin user
        $this->adminUser = User::factory()->create([
            'name' => 'Admin Desa',
            'email' => 'admin@desa.go.id',
        ]);
    }

    /**
     * Test admin can access news and events listing.
     */
    public function test_admin_can_access_news_and_events_panel(): void
    {
        $response = $this->actingAs($this->adminUser)
            ->get(route('admin.news.index'));
        $response->assertStatus(200);

        $response = $this->actingAs($this->adminUser)
            ->get(route('admin.events.index'));
        $response->assertStatus(200);
    }

    /**
     * Test guest cannot access admin news/events panel.
     */
    public function test_guest_cannot_access_news_and_events_panel(): void
    {
        $response = $this->get(route('admin.news.index'));
        $response->assertRedirect(route('admin.login'));

        $response = $this->get(route('admin.events.index'));
        $response->assertRedirect(route('admin.login'));
    }

    /**
     * Test admin can create news.
     */
    public function test_admin_can_create_news(): void
    {
        $category = KategoriBerita::create([
            'nama' => 'Pengumuman',
            'slug' => 'pengumuman'
        ]);

        $response = $this->actingAs($this->adminUser)
            ->post(route('admin.news.store'), [
                'judul' => 'Uji Coba Berita Baru',
                'kategori_id' => $category->id,
                'konten' => 'Ini adalah konten uji coba berita baru.',
                'gambar' => 'fa-bullhorn',
                'status' => 'published'
            ]);

        $response->assertRedirect(route('admin.news.index'));
        $this->assertDatabaseHas('berita', [
            'judul' => 'Uji Coba Berita Baru',
            'status' => 'published',
        ]);
    }

    /**
     * Test admin can create event.
     */
    public function test_admin_can_create_event(): void
    {
        $response = $this->actingAs($this->adminUser)
            ->post(route('admin.events.store'), [
                'judul' => 'Uji Coba Kegiatan Baru',
                'deskripsi' => 'Deskripsi untuk kegiatan uji coba.',
                'tanggal_mulai' => '2026-07-01',
                'tanggal_selesai' => '2026-07-02',
                'lokasi' => 'Balai Pertemuan',
                'status' => 'rencana'
            ]);

        $response->assertRedirect(route('admin.events.index'));
        $this->assertDatabaseHas('kegiatan', [
            'judul' => 'Uji Coba Kegiatan Baru',
            'status' => 'rencana',
        ]);
    }

    /**
     * Test admin can create news with photo upload.
     */
    public function test_admin_can_create_news_with_photo(): void
    {
        $category = KategoriBerita::create([
            'nama' => 'Pengumuman',
            'slug' => 'pengumuman'
        ]);

        $file = \Illuminate\Http\UploadedFile::fake()->create('news_photo.jpg', 100, 'image/jpeg');

        $response = $this->actingAs($this->adminUser)
            ->post(route('admin.news.store'), [
                'judul' => 'Berita Dengan Foto',
                'kategori_id' => $category->id,
                'konten' => 'Ini adalah konten berita dengan foto.',
                'gambar' => 'fa-bullhorn',
                'foto' => $file,
                'status' => 'published'
            ]);

        $response->assertRedirect(route('admin.news.index'));
        
        // Retrieve the created news to verify its gambar field starts with 'uploads/news/'
        $news = Berita::where('judul', 'Berita Dengan Foto')->first();
        $this->assertNotNull($news);
        $this->assertStringStartsWith('uploads/news/', $news->gambar);
        
        // Assert file exists in public directory
        $filePath = public_path($news->gambar);
        $this->assertFileExists($filePath);

        // Cleanup the file
        if (file_exists($filePath)) {
            @unlink($filePath);
        }
    }
}
