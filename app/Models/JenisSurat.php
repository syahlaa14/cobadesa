<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    protected $table = 'jenis_surat';
    protected $guarded = [];

    public function surat()
    {
        return $this->hasMany(Surat::class, 'jenis_surat_id');
    }
}
