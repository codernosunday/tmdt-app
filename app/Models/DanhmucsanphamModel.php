<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhmucsanphamModel extends Model
{
    use HasFactory;
    protected $table = 'danhmucsanpham';
    protected $fillable = [
        'tendanhmuc',
        'ghichu',
    ];
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
}

