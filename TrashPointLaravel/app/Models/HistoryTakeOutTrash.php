<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryTakeOutTrash extends Model
{
    protected $table = 'history_take_out_trash';
    protected $primaryKey = 'idHistoryTakeOutTrash';

    protected $fillable = [
        'idMasyarakat',
        'idTrash',
    ];

    public function masyarakat()
    {
        return $this->belongsTo(Masyarakat::class, 'idMasyarakat', 'idMasyarakat');
    }

    public function trash()
    {
        return $this->belongsTo(Trash::class, 'idTrash', 'idTrash');
    }
}
