<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ChitietsanphamModel;
use App\Models\hoadonModel;
use App\Models\giasaleModel;

class cthoadonModel extends Model
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
    public function ctsp()
    {
        return $this->belongsTo(ChitietsanphamModel::class, 'id_ctsp');
    }
    public function hoadon()
    {
        return $this->belongsTo(hoadonModel::class, 'id_hoadon');
    }
    public function giasale()
    {
        return $this->belongsTo(giasaleModel::class, 'id_giasale');
    }
}
