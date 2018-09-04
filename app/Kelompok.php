<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    protected $table = 'kelompok';
    protected $guarded = [];

    public function pengecekan()
    {
        return $this->hasMany(Pengecekan::class);
    }

    public function pengecekankecamatan()
    {
        return $this->hasMany(Pengecekan::class)->groupBy('kecamatan');
    }
    
}
