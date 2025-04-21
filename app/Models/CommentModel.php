<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentModel extends Model
{
    protected $table = 'binhluan';
    protected $primaryKey = 'id_bl';
    public $incrementing = true; // id_bl tự động tăng

    protected $fillable = [
        'id_sp',
        'id_nd',
        'id_ctsp',
        'sosao',
        'danhgia',
        'noidungbinhluan',
        'created_at',
        'updated_at',
    ];

    public function nguoidung()
    {
        return $this->belongsTo(NguoidungModel::class, 'id_nd');
    }
    public function sanpham()
    {
        return $this->belongsTo(SanphamModel::class, 'id_sp');
    }
    public function ctsp()
    {
        return $this->belongsTo(ChitietsanphamModel::class, 'id_ctsp');
    }

    // Ánh xạ các cột với thuộc tính
    public function getRatingAttribute()
    {
        return $this->sosao;
    }

    public function getContentAttribute()
    {
        return $this->noidungbinhluan;
    }
}