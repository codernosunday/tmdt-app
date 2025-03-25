<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gianhapModel extends Model
{
    use HasFactory;
    protected $table = 'gianhap';
    protected $primaryKey = 'id_gianhap';
    protected $fillable = [
        'id_sp',
        'id_nhacungcap',
        'gianhap',
        'soluong'
    ];
    public $timestamps = true;
}
