<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DanhmucsanphamModel;

class DanhmucconModel extends Model
{
    use HasFactory;
    protected $table = 'bangdanhmuc';
    protected $primaryKey = 'id_ctdm';
    protected $fillable = [
        'id_dm',
        'id_ctdm',
        'ten',
        'ghichu',
    ];
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    public function danhmuccha()
    {
        return $this->belongsTo(DanhmucsanphamModel::class, 'id_dm');
    }
    public function sanpham()
    {
        return $this->hasMany(SanphamModel::class, 'id_ctdm', 'id_ctdm');
    }
}
