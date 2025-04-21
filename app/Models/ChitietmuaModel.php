<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ChitietsanphamModel;
use App\Models\hoadonModel;

class ChitietmuaModel extends Model
{
    use HasFactory;
    protected $table = 'chitietmua';
    protected $primaryKey = 'id_ctm';
    protected $fillable = [
        'id_ctsp',
        'id_hoadon',
        'id_giasale',
        'soluong',
        'thanhtien',
    ];
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    public function chitietsanpham()
    {
        return $this->belongsTo(ChitietsanphamModel::class, 'id_ctsp');
    }
    public function hoadon()
    {
        return $this->hasOne(hoadonModel::class, 'id_hoadon');
    }
}
