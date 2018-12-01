<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenyerahanDetail extends Model
{
    protected $table = 'penyerahan_detail';

    public function penyerahanheader()
    {
        return $this->belongsTo('App\Penyerahan','penyerahan_id','id');
    }
}
