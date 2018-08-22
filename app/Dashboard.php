<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    protected $table = 'dasboard';
    protected $guarded = [];
    protected $appends = ['sisaappend'];

    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class);
    }


    public function getSisaappendAttribute($value)
    {
        $warkah = $this->kelompok[''];
    }
}
