<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GioHangModel extends Model
{
    protected $table = 'ten_bang_cua_ban'; 

    protected $primaryKey = 'id_giohang'; 

    public $timestamps = true;
}
