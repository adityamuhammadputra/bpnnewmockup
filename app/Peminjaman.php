<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $guarded = [];

    public function peminjamandetail()
    {
        return $this->hasMany(PeminjamanDetail::class);
        
    }

    public function kegiatan()
    {
        return $this->belongsTo('App\Kegiatan', 'kegiatan', 'id');
    }
}
