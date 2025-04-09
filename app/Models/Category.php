<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Nếu bảng trong database không theo chuẩn Laravel (vd: không phải "categories"), thêm dòng này:
    // protected $table = 'ten_bang_trong_database';

    // Nếu cần, định nghĩa quan hệ với sản phẩm
    public function products()
    {
        return $this->hasMany(Product::class, 'id_dm', 'id');
    }
}
