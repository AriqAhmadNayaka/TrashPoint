<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'idUser';

    protected $fillable = [
        'username',
        'email',
        'password',
        'phoneNumber',
        'role',
        'status',
    ];

    public function masyarakat()
    {
        return $this->hasOne(Masyarakat::class, 'idMasyarakat', 'idUser');
    }

    public function petugas()
    {
        return $this->hasOne(Petugas::class, 'idPetugas', 'idUser');
    }

    public function admin()
    {
        return $this->hasOne(Admin::class, 'idAdmin', 'idUser');
    }
}
