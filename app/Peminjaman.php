<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $guarded = [];

    protected $appends = ['jumlahpinjam', 'jumlahpinjamkegiatan'];


    public function peminjamandetail()
    {
        return $this->hasMany(PeminjamanDetail::class)->where('status_detail',[0]);
        
    }

    public function peminjamandetailcetak()
    {
        return $this->hasMany(PeminjamanDetail::class)->whereNotIn('status_detail', [1, 2, 3]);
    }

    public function getJumlahPinjamAttribute($value)
    {
        return $this->peminjamandetail->whereNotIn('status_detail', [1, 2, 3])->count();
    }

    public function getJumlahPinjamKegiatanAttribute($value)
    {
        return $this->peminjamandetail->where('status_detail',0)->count();
    }

    public function kegiatan()
    {
        return $this->belongsTo('App\Kegiatan', 'kegiatan', 'id');
    }

    public function kegiatanvia()
    {
        return $this->belongsTo('App\Via', 'via', 'kegiatan_id');
    }
    
}
