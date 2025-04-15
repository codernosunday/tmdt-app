<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vanchuyenModel extends Model
{
    use HasFactory;
    protected $table = 'phivanchuyen';
    protected $primaryKey = 'id_phi';
    protected $fillable = [
        'giaphi',
        'khuvuc',
        'phuongthuc',
        'ghichu',
    ];
    public $timestamps = true;
    // public function nguoidung()
    // {
    //     return $this->belongsTo(NguoidungModel::class, 'id_nd');
    // }
}
