<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTrash extends Model
{
    // Pastikan nama tabel sesuai dengan di database
    protected $table = 'detail_trash'; 
    
    // Izinkan pengisian data jika diperlukan
    protected $fillable = ['trash_id', 'berat', 'kapasitas']; 
}