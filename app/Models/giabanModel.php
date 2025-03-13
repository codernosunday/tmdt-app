<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class giabanModel extends Model
{
    use HasFactory;
    protected $table = 'giaban';
    protected $fillable = [
        'id_sp',
        'giaban'
    ];
    public $timestamps = true;
}
