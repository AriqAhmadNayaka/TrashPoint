<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Masyarakat extends Model
{
    protected $table = 'masyarakat';
    protected $primaryKey = 'idMasyarakat';

    protected $fillable = [
        'idMasyarakat',
        'idUser',
        'points',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idMasyarakat', 'idUser');
    }

    public function historyVouchers()
    {
        return $this->hasMany(HistoryVoucher::class, 'idMasyarakat', 'idMasyarakat');
    }

    public function historyTakeOutTrashes()
    {
        return $this->hasMany(HistoryTakeOutTrash::class, 'idMasyarakat', 'idMasyarakat');
    }
}
