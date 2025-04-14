<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ChitietsanphamModel;

class ChitietgiohangModel extends Model
{
    use HasFactory;
    protected $table = 'chitietgiohang';
    protected $primary = 'id_ctgh';
    protected $fillable = [
        'id_ctsp',
        'id_giohang',
        'id_sp',
        'soluong',
    ];

    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';

    public function ctsp()
    {
        return $this->belongsTo(ChitietsanphamModel::class, 'id_ctsp');
    }

    public function sanpham()
    {
        return $this->belongsTo(SanphamModel::class, 'id_sanpham', 'id_sp');
    }
}
