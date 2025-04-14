<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SanphamModel;
use App\Models\ChitietsanphamModel;

class giabanModel extends Model
{
    use HasFactory;
    protected $table = 'giaban';
    protected $primaryKey = 'id_giaban';
    protected $fillable = [
        'id_ctsp',
        'id_sp',
        'giaban'
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
}
