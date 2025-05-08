<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SanphamModel;
use App\Models\ChitietsanphamModel;

class gianhapModel extends Model
{
    use HasFactory;
    protected $table = 'gianhap';
    protected $primaryKey = 'id_gianhap';
    protected $fillable = [
        'id_sp',
        'id_ctsp',
        'id_nhacungcap',
        'gianhap',
        'soluong'
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
    public function nhacungcap()
    {
        return $this->belongsTo(nhacungcapModel::class, 'id_nhacungcap');
    }
}
