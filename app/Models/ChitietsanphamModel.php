<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SanphamModel;
use App\Models\giabanModel;
use App\Models\gianhapModel;
use App\Models\ThuoctinhspModel;
use App\Models\DanhmucsanphamModel;

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
    public function sanpham()
    {
        return $this->belongsTo(SanphamModel::class, 'id_sp');
    }
    public function giaban()
    {
        return $this->hasOne(giabanModel::class, 'id_ctsp');
    }
    public function gianhap()
    {
        return $this->hasOne(gianhapModel::class, 'id_ctsp');
    }
    public function thuoctinh()
    {
        return $this->belongsTo(ThuoctinhspModel::class, 'id_thuoctinh');
    }
    public function danhmuc()
    {
        return $this->belongsTo(DanhmucsanphamModel::class, 'id_dm', 'id_dm');
    }
}
