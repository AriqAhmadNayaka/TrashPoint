<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
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
