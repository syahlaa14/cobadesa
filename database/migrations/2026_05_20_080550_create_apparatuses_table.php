<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('perangkat_desa', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jabatan');
            $table->text('keterangan_jabatan')->nullable();
            $table->string('nip')->nullable();
            $table->string('sk_pengangkatan')->nullable();
            $table->date('tanggal_sk')->nullable();
            $table->boolean('status_aktif')->default(true);
            $table->string('foto')->nullable();
            
            // Kolom sosial media untuk kompatibilitas frontend
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perangkat_desa');
    }
};
