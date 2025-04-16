<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\NguoidungModel;
use App\Models\htthanhtoanModel;
use App\Models\vanchuyenModel;
use App\Models\thanhtoanModel;

class hoadonModel extends Model
{
    use HasFactory;
    protected $table = 'hoadon';
    protected $primaryKey = 'id_hoadon';
    protected $fillable = [
        'id_nd',
        'id_hinhthuc',
        'id_phi',
        'sodt',
        'madonhang',
        'hoten',
        'email',
        'tongtien',
        'diachigiaohang',
        'ghichu',
        'trangthaidonhang',
        'hinhthucthanhtoan',
        'noidungchuyenkhoan'
    ];
    public $timestamps = true;
    public function nguoidung()
    {
        return $this->belongsTo(NguoidungModel::class, 'id_nd');
    }
    public function hinhthuc()
    {
        return $this->belongsTo(htthanhtoanModel::class, 'id_hinhthuc');
    }
    public function vanchuyen()
    {
        return $this->belongsTo(vanchuyenModel::class, 'id_phi');
    }
    public function chitiet()
    {
        return $this->hasOne(thanhtoanModel::class, 'id_hoadon', 'id_hoadon'); // chỉnh lại tên khóa nếu khác
    }
}
