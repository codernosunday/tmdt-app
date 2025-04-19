<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\hoadonModel;

class vanchuyenModel extends Model
{
    use HasFactory;
    protected $table = 'phivanchuyen';
    protected $primaryKey = 'id_phi';
    protected $fillable = [
        'id_phi',
        'giaphi',
        'khuvuc',
        'phuongthuc',
        'ghichu',
    ];
    public $timestamps = true;
    public function hoadon()
    {
        return $this->hasMany(hoadonModel::class, 'id_phi');
    }
}
