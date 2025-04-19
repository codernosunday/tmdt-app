<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\hoadonModel;

class thanhtoanModel extends Model
{
    use HasFactory;
    protected $table = 'thanhtoan';
    protected $primaryKey = 'id_thanhtoan';
    protected $fillable = [
        'id_thanhtoan',
        'id_phi',
        'trangthaithanhtoan',
        'ndthanhtoan',
    ];
    public $timestamps = true;
    public function hoadon()
    {
        return $this->belongsTo(hoadonModel::class, 'id_thanhtoan');
    }
}
