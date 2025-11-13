<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTrashSchedule extends Model
{
    protected $table = 'detail_trash_schedule';
    protected $primaryKey = 'idDetailTrashSchedule';

    protected $fillable = [
        'idTrashSchedule',
        'idTrash',
    ];

    public function trashSchedule()
    {
        return $this->belongsTo(TrashSchedule::class, 'idTrashSchedule', 'idTrashSchedule');
    }

    public function trash()
    {
        return $this->belongsTo(Trash::class, 'idTrash', 'idTrash');
    }
}
