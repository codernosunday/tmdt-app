<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class diachiModel extends Model
{
    use HasFactory;
    protected $table = 'diachi';
    protected $primaryKey = 'id_dchi';

    protected $fillable = [
        'id_nd',
        'diachi1',
        'quocgia',
        'tinh',
        'huyen',
        'xa',
    ];
    public function nguoidung()
    {
        return $this->belongsTo(NguoidungModel::class, 'id_nd');
    }
}
