<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SanphamModel;
use App\Models\ChitietsanphamModel;
use App\Models\giasaleModel;

class giabanModel extends Model
{
    use HasFactory;
    protected $table = 'giaban';
    protected $primaryKey = 'id_giaban';
    protected $fillable = [
        'id_ctsp',
        'id_sp',
        'id_giasale',
        'giaban',
        'giabanmoi'
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
    public function giasale()
    {
        return $this->belongsTo(giasaleModel::class, 'id_giasale');
    }
}
