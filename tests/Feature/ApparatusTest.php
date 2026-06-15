<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Apparatus;

class ApparatusTest extends TestCase
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
     * Test admin can access apparatus listing.
     */
    public function test_admin_can_access_apparatus_panel(): void
    {
        $response = $this->actingAs($this->adminUser)
            ->get(route('admin.apparatus.index'));
        $response->assertStatus(200);
    }

    /**
     * Test guest cannot access admin apparatus panel.
     */
    public function test_guest_cannot_access_apparatus_panel(): void
    {
        $response = $this->get(route('admin.apparatus.index'));
        $response->assertRedirect(route('admin.login'));
    }

    /**
     * Test admin can create apparatus with photo upload.
     */
    public function test_admin_can_create_apparatus_with_photo(): void
    {
        $file = \Illuminate\Http\UploadedFile::fake()->create('apparatus_photo.jpg', 100, 'image/jpeg');

        $response = $this->actingAs($this->adminUser)
            ->post(route('admin.apparatus.store'), [
                'nama' => 'Drs. Edi Mulyono',
                'jabatan' => 'Sekretaris Desa',
                'keterangan_jabatan' => 'Mengoordinasikan urusan kemasyarakatan.',
                'foto' => 'fa-user',
                'foto_file' => $file,
                'status_aktif' => 1
            ]);

        $response->assertRedirect(route('admin.apparatus.index'));
        
        $apparatus = Apparatus::where('nama', 'Drs. Edi Mulyono')->first();
        $this->assertNotNull($apparatus);
        $this->assertStringStartsWith('uploads/apparatus/', $apparatus->foto);
        
        // Assert file exists in public directory
        $filePath = public_path($apparatus->foto);
        $this->assertFileExists($filePath);

        // Cleanup
        if (file_exists($filePath)) {
            @unlink($filePath);
        }
    }

    /**
     * Test admin can delete apparatus.
     */
    public function test_admin_can_delete_apparatus(): void
    {
        // Create an apparatus with photo path
        $photoName = 'temp_del_' . time() . '.jpg';
        $targetDir = public_path('uploads/apparatus');
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0755, true);
        }
        $filePath = $targetDir . '/' . $photoName;
        file_put_contents($filePath, 'fake image data');

        $apparatus = Apparatus::create([
            'nama' => 'Aparatur Dihapus',
            'jabatan' => 'Staff IT',
            'keterangan_jabatan' => 'Mengurus server.',
            'foto' => 'uploads/apparatus/' . $photoName,
            'status_aktif' => 1
        ]);

        $this->assertFileExists($filePath);

        // Send delete request
        $response = $this->actingAs($this->adminUser)
            ->delete(route('admin.apparatus.destroy', $apparatus->id));

        $response->assertRedirect(route('admin.apparatus.index'));

        // Assert database record deleted
        $this->assertDatabaseMissing('perangkat_desa', [
            'id' => $apparatus->id
        ]);

        // Assert file deleted from disk
        $this->assertFileDoesNotExist($filePath);
    }
}
