<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengecekan extends Model
{
    protected $table = 'tbl_pengecekan';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
