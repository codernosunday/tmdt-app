<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\vanchuyenModel;
use App\Models\hoadonModel;

class thanhtoanModel extends Model
{
    use HasFactory;
    protected $table = 'thanhtoan';
    protected $primaryKey = 'id_thanhtoan';
    protected $fillable = [
        'id_thanhtoan',
        'id_phi',
        'trangthaidonhang',
        'hinhthucthanhtoan',
    ];
    public $timestamps = true;
    public function vanchuyen()
    {
        return $this->belongsTo(vanchuyenModel::class, 'id_phi');
    }
    public function hoadon()
    {
        return $this->belongsTo(hoadonModel::class, 'id_thanhtoan');
    }
}
