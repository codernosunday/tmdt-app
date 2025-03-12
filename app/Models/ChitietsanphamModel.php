<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChitietsanphamModel extends Model
{
    use HasFactory;
    protected $table = 'chitietsanpham';
    protected $fillable = [
        'id_sp',
        'id-thuoctinh',
        'giasp',
        'anhsp',
        'gianhap',
        'giasale',
        'soluong',
        'mota',
        'nhasanxuat'
    ];
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
}
