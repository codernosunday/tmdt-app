<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ChitietsanphamModel;

class ThuoctinhspModel extends Model
{
    use HasFactory;
    protected $table = 'thuoctinhsanpham';
    protected $primaryKey = 'id_thuoctinh';
    protected $fillable = [
        'loai',
        'danhsachspgoiy',
        'kichthuoc',
        'mota',
        'mau',
        'mamau'
    ];
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    public function ctsp()
    {
        return $this->hasOne(ChitietsanphamModel::class, 'id_thuoctinh');
    }
}
