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
        'anhbase64',
        'tomtatsp',
        'tinhtrang',
        'trangthai'
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
        return $this->hasOne(ChitietsanphamModel::class, 'id_sp', 'id_sp'); // chỉnh lại tên khóa nếu khác
    }

    public function chitietsanpham()
    {
        return $this->hasMany(ChitietsanphamModel::class, 'id_sp', 'id_sp');
    }

    public function danhgia()
    {
        return $this->hasMany(DanhgiaModel::class, 'id_sp', 'id_sp');
    }

    public function ratingDistribution()
    {
        $distribution = [
            5 => 0,
            4 => 0,
            3 => 0,
            2 => 0,
            1 => 0
        ];

        // Đếm số lượng đánh giá cho mỗi mức điểm
        $this->danhgia->each(function($danhgia) use (&$distribution) {
            if (isset($distribution[$danhgia->diem])) {
                $distribution[$danhgia->diem]++;
            }
        });

        return $distribution;
    }
}
