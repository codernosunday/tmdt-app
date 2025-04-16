<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\hoadonModel;

class htthanhtoanModel extends Model
{
    use HasFactory;
    protected $table = 'hinhthucthanhtoan';
    protected $primaryKey = 'id_hinhthuc';
    protected $fillable = [
        'tenhinhthuc',
        'sodt',
        'sotk',
        'nganhang',
        'tenchu',
        'QRcode',
        'khac',
    ];
    public $timestamps = true;
    public function hoadon()
    {
        return $this->hasOne(hoadonModel::class, 'id_hinhthuc', 'id_hinhthuc'); // chỉnh lại tên khóa nếu khác
    }
}
