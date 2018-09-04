<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BukuTanah extends Model
{
    protected $table = 'peminjaman_master';
    protected $guarded = [];


    public function getStatusAttribute()
    {
        $data = $this->attributes['status'];
        if($data == 1){
            return "Ada"; 
        }
        else {
            return "Tidak Ada";
        }
    }
}
