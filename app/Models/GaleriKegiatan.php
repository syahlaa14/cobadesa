<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleriKegiatan extends Model
{
    protected $table = 'galeri_kegiatan';
    protected $guarded = [];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id');
    }
}
