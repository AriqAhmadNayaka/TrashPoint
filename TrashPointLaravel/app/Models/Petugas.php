<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $table = 'petugas';
    protected $primaryKey = 'idPetugas';

    protected $fillable = [
        'idPetugas',
        'idUser',
        // Add other petugas-specific fields here
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser', 'idUser');
    }

    public function trashSchedules()
    {
        return $this->hasMany(TrashSchedule::class, 'idPetugas', 'idPetugas');
    }
}
