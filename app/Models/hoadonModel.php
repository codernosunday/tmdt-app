<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\NguoidungModel;

class hoadonModel extends Model
{
    use HasFactory;
    protected $table = 'hoadon';
    protected $primaryKey = 'id_hoadon';
    protected $fillable = [
        'id_nd',
        'sodt',
        'madonhang',
        'hoten',
        'email',
        'tongtien',
        'diachigiaohang',
        'ghichu',
    ];
    public $timestamps = true;
    public function nguoidung()
    {
        return $this->belongsTo(NguoidungModel::class, 'id_nd');
    }
}
