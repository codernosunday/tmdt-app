<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'bangdanhmuc'; // Tên bảng trong cơ sở dữ liệu
    protected $primaryKey = 'id_ctdm'; // Khóa chính
    public $timestamps = true; // Nếu bảng có cột `created_at` và `updated_at`

    public function products()
    {
        return $this->hasMany(SanphamModel::class, 'id_ctdm', 'id_ctdm'); // Quan hệ với bảng sản phẩm
    }
}
