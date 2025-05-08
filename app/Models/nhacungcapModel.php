<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nhacungcapModel extends Model
{
    use HasFactory;
    protected $table = 'nhacungcap';
    protected $primaryKey = 'id_nhacungcap';
    protected $fillable = [
        'ten',
        'lienhe',
    ];
    public $timestamps = true;
    public function gianhap()
    {
        return $this->hasOne(gianhapModel::class, 'id_nhacungcap');
    }
}
