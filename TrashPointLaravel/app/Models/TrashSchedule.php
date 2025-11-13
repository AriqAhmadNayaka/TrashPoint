<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrashSchedule extends Model
{
    protected $table = 'trash_schedule';
    protected $primaryKey = 'idTrashSchedule';

    protected $fillable = [
        'idPetugas',
        'idAdmin',
        'scheduleDateTime',
        'status',
    ];

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'idPetugas', 'idPetugas');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'idAdmin', 'idAdmin');
    }

    public function detailTrashSchedules()
    {
        return $this->hasMany(DetailTrashSchedule::class, 'idTrashSchedule', 'idTrashSchedule');
    }
}
