<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanphamModel extends Model
{
    use HasFactory;
    protected $table = 'sanpham';
    protected $primaryKey = 'id_sp';
    protected $fillable = [
        'id_ctdm',
        'tensp',
        'anh',
        'tomtatsp'
    ];
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    public function giaban()
    {
        return $this->hasOne(GiabanModel::class, 'id_sp')
            ->latest('updated_at');
    }
}
