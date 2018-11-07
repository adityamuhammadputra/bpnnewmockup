<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeminjamanDetail extends Model
{
    protected $table = 'peminjaman_detail';
    protected $guarded = [];

    public function peminjamanheader()
    {
        // return $this->belongsTo(Peminjaman::class);
        return $this->belongsTo('App\Peminjaman', 'peminjaman_id', 'id')->with('kegiatan');

    }

    public function peminjamanheaders()
    {
        return $this->hasOne('App\Peminjaman','id','peminjaman_id')->with('kegiatan');
    }
}
