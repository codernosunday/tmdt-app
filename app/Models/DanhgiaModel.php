<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanhgiaModel extends Model
{
    protected $table = 'binhluan';
    protected $primaryKey = 'id_bl';
    
    protected $fillable = [
        'id_sp',
        'id_nd',
        'id_ctsp',
        'sosao',
        'danhgia',
        'noidungbinhluan',
        'created_at',
        'updated_at'
    ];

    public function sanpham()
    {
        return $this->belongsTo(SanphamModel::class, 'id_sp', 'id_sp');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function chitietSanpham()
    {
        return $this->belongsTo(ChitietSanphamModel::class, 'id_ctsp', 'id_ctsp');
    }

    public function nguoidung()
    {
        return $this->belongsTo(NguoidungModel::class, 'id_nd', 'id_nd');
    }
}
