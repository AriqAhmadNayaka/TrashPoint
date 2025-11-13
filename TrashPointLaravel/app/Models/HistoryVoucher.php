<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryVoucher extends Model
{
    protected $table = 'history_voucher';
    protected $primaryKey = 'idHistoryVoucher';

    protected $fillable = [
        'idMasyarakat',
        'idVoucher',
    ];

    public function masyarakat()
    {
        return $this->belongsTo(Masyarakat::class, 'idMasyarakat', 'idMasyarakat');
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class, 'idVoucher', 'idVoucher');
    }
}
