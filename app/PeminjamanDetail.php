<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeminjamanDetail extends Model
{
    protected $table = 'peminjaman_detail';
    protected $guarded = [];

    public function peminjamanmaster()
    {
        return $this->hasMany('App\PeminjamanMaster', 'id', 'peminjaman_master_id');
    }
}
