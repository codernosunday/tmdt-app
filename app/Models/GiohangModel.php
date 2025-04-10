<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GioHangModel extends Model
{
    protected $table = 'giohang'; 

    protected $primaryKey = 'id_giohang'; 

    protected $fillable = [
        'id_giohang'
    ];

    public $timestamps = true;
}
