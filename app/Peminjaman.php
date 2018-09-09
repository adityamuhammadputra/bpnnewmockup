<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $guarded = [];

    public function peminjamandetail()
    {
        return $this->hasMany(PeminjamanDetail::class)->with('peminjamanmaster');
        

    }
}