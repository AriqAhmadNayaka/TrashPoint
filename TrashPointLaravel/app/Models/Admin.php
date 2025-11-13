<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'idAdmin';

    protected $fillable = [
        'idAdmin',
        'idUser',
        // Add other admin-specific fields here
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idAdmin', 'idUser');
    }

    public function trashSchedules()
    {
        return $this->hasMany(TrashSchedule::class, 'idAdmin', 'idAdmin');
    }
}
