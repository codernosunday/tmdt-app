<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThuoctinhspModel extends Model
{
    use HasFactory;
    protected $table = 'thuoctinh';
    protected $fillable = [
        'loai',
        'mota'
    ];
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
}
