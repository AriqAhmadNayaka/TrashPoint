<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = 'voucher';
    protected $primaryKey = 'idVoucher';

    protected $fillable = [
        'voucherName',
        'price',
        'status',
    ];

    public function historyVouchers()
    {
        return $this->hasMany(HistoryVoucher::class, 'idVoucher', 'idVoucher');
    }
}
