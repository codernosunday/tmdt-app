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
        'id-thuoctinh',
        'chieurong',
        'chieucao',
        'doday',
        'soluong',
        'sotrang',
        'thuonghieu',
        'mausac',
        'mammau',
        'anhsp',
        'dattinh'
    ];
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
}
