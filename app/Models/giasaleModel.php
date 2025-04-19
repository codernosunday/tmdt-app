<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SanphamModel;
use App\Models\ChitietsanphamModel;
use App\Models\DanhmucconModel;
use App\Models\DanhmucsanphamModel;
use App\Models\giabanModel;

class giasaleModel extends Model
{
    use HasFactory;
    protected $table = 'giasale';
    protected $primaryKey = 'id_giasale';
    protected $fillable = [
        'id_sp',
        'id_ctsp',
        'id_dm',
        'id_ctdm',
        'ten',
        'magiamgia',
        'trangthai',
        'giasale',
        'ketthuc',
    ];
    public $timestamps = true;
    public function sanpham()
    {
        return $this->belongsTo(SanphamModel::class, 'id_sp');
    }
    public function ctsp()
    {
        return $this->belongsTo(ChitietsanphamModel::class, 'id_ctsp');
    }
    public function danhmucsanpham()
    {
        return $this->belongsTo(DanhmucsanphamModel::class, 'id_dm');
    }
    public function danhmuccon()
    {
        return $this->belongsTo(DanhmucconModel::class, 'id_ctdm');
    }
    public function giaban()
    {
        return $this->hasMany(giabanModel::class, 'id_giasale');
    }
}
