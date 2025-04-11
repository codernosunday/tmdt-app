<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanphamModel extends Model
{
    use HasFactory;
    protected $table = 'sanpham';
    protected $primaryKey = 'id_sp';
    protected $fillable = [
        'id_ctdm',
        'tensp',
        'anh',
        'tomtatsp',
        'tinhtrang'
    ];
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    public function giaban()
    {
        return $this->hasOne(GiabanModel::class, 'id_sp')
            ->latest('updated_at');
    }
    public function chitiet()
    {
        return $this->hasOne(ChitietsanphamModel::class, 'id_sanpham', 'id_sp'); // chỉnh lại tên khóa nếu khác
    }

    public function chitietsanpham()
    {
        return $this->hasMany(ChitietsanphamModel::class, 'id_sp', 'id_sp');
    }
}
