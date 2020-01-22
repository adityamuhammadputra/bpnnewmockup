<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $fillable = [
        'name', 'email', 'password','nik','photo','status', 'jabatan_profile'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class);
    }

    public function getEmailAttribute($value)
    {
        return substr($value, 0, -10); //menghapus @gmail.com
    }

    
}
