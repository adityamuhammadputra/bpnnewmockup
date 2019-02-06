<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeminjamanPengecekan extends Model
{
    protected $table = 'peminjaman_pengecekan';
    protected $guarded = [''];
    protected $appends = ['statussu','statusbt','labelsu','labelbt'];

    public function getStatussuAttribute()
    {
        if ($this->attributes['status_pinjam'] == 0) {
            return "btn btn-success";
        }else {
            return "btn btn-warning";
        }
        
    }
    public function getStatusBtAttribute()
    {
        if ($this->attributes['status_pinjam2'] == 0) {
            return "btn btn-success";
        }else {
            return "btn btn-warning";
        }
    }

    public function getLabelsuAttribute()
    {
        if ($this->attributes['status_pinjam'] == 0) {
            return 'label label-success">Tersedia';
        }else {
            return 'label label-warning">Tidak Tersedia';
        }
    }
    public function getLabelbtAttribute()
    {
        if ($this->attributes['status_pinjam2'] == 0) {
            return 'label label-success">Tersedia';
        }else {
            return 'label label-warning">Tidak Tersedia';
        }
    }
}
