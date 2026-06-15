<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Penduduk;
use App\Models\JenisSurat;
use App\Models\Surat;

class SuratTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test successful draft letter request submission.
     */
    public function test_warga_can_submit_layanan_surat_successfully(): void
    {
        $response = $this->postJson(route('surat.submit'), [
            'name' => 'Budi Santoso Warga',
            'nik' => '3204123456789012',
            'address' => 'RT 01 / RW 02, Dusun Pasir',
            'detail' => 'Toko Kelontong Budi Makmur',
            'type' => 'sku',
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Draf surat Surat Keterangan Usaha berhasil didaftarkan!',
                 ]);

        // Assert Penduduk created
        $this->assertDatabaseHas('penduduk', [
            'nik' => '3204123456789012',
            'nama_lengkap' => 'Budi Santoso Warga',
        ]);

        // Assert Surat created
        $this->assertDatabaseHas('surat', [
            'keterangan' => 'Toko Kelontong Budi Makmur',
            'status' => 'pending',
        ]);
    }

    /**
     * Test validation fails when required fields are missing.
     */
    public function test_layanan_surat_validation_fails(): void
    {
        $response = $this->postJson(route('surat.submit'), [
            'name' => '',
            'nik' => '12345', // invalid length
            'address' => 'Bandung',
            'detail' => '',
            'type' => 'invalid-type', // invalid type
        ]);

        $response->assertStatus(422);
    }
}
