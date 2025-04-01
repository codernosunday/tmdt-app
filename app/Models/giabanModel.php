<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SanphamModel;

class giabanModel extends Model
{
    use HasFactory;
    protected $table = 'giaban';
    protected $primaryKey = 'id_giaban';
    protected $fillable = [

        'id_sp',
        'giaban'
    ];
    public $timestamps = true;
    public function sanpham()
    {
        return $this->belongsTo(SanphamModel::class, 'id_sp');
    }
}
