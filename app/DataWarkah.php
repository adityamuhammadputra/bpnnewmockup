<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataWarkah extends Model
{
    protected $table = 'tbl_datawarkah';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class)->with('kelompok');
    }
    
}
