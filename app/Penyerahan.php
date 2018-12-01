<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penyerahan extends Model
{
    protected $table = 'penyerahan';
    protected $guarded = [];
    protected $appends = ['jumlah'];


    public function penyerahandetail()
    {
        return $this->hasMany(PenyerahanDetail::class);

    }
    public function kegiatan()
    {
        return $this->belongsTo('App\Kegiatan', 'kegiatan_id', 'id');
    }

    public function getJumlahAttribute($value)
    {
        return $this->penyerahandetail->whereNotIn('status', [1, 2, 3])->count();
    }
}
