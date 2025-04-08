<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChitietsanphamModel extends Model
{
    use HasFactory;
    protected $table = 'chitietsanpham';
    protected $primaryKey = 'id_ctsp';
    protected $fillable = [
        'id_sp',
        'id_thuoctinh',
        'kichthuoc',
        'thuonghieu',
        'xuatsu',
        'sanxuat',
        'khuyencao',
        'loiich',
        'tieuchuan',
        'loiich',
        'tinhnangnoibat',
        'trangthai',

        'soluong',
        'tenchitiet',
        'sotrang',

        'mausac',
        'doday',
        'mamau',
        'anhsp',
        'dattinh'
    ];
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
}
