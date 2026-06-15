<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    protected $table = 'penduduk';
    protected $guarded = [];

    public function anggotaKeluarga()
    {
        return $this->hasMany(AnggotaKeluarga::class, 'penduduk_id');
    }

    public function surat()
    {
        return $this->hasMany(Surat::class, 'penduduk_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'penduduk_id');
    }
}
