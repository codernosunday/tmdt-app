<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhmucconModel extends Model
{
    use HasFactory;
    protected $table = 'bangdanhmuc';
    protected $fillable = [
        'id_dm',
        'ten',
        'ghichu',
    ];
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
}
