<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trash extends Model
{
    protected $table = 'trash';
    protected $primaryKey = 'idTrash';

    protected $fillable = [
        'idTrash',
        'province',
        'city',
        'roadAddress',
        'latitude',
        'longitude',
        'status',
    ];

    public function historyTakeOutTrashes()
    {
        return $this->hasMany(HistoryTakeOutTrash::class, 'idTrash', 'idTrash');
    }

    public function detailTrashSchedules()
    {
        return $this->hasMany(DetailTrashSchedule::class, 'idTrash', 'idTrash');
    }
}
