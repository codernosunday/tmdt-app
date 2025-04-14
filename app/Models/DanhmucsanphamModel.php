<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DanhmucconModel;

class DanhmucsanphamModel extends Model
{
    use HasFactory;
    protected $table = 'danhmucsanpham';
    protected $primaryKey = 'id_dm';
    protected $fillable = [
        'tendanhmuc',
        'ghichu',
    ];
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    public function danhmucon()
    {
        return $this->hasOne(DanhmucconModel::class, 'id_dm');
    }
}

