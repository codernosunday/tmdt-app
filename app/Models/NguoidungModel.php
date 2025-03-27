<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NguoidungModel extends Model
{
    use HasFactory;

    protected $table = 'nguoidung';

    protected $fillable = [
        'hovaten',
        'username',
        'password',
        'ngaysinh',
        'soDT',
        'mail',
        'ngaytao',
        'quyentruycap',
        'maxacnhan'
    ];
    public $timestamps = true;
    protected $dates = ['ngaysinh', 'ngaytao'];
    protected $hidden = ['password'];
}
