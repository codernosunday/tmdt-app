<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Đổi từ Model thành Authenticatable
use Illuminate\Notifications\Notifiable;

class NguoidungModel extends Authenticatable
{
    use Notifiable;

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
        'maxacnhan',
        'solannhapsai'
    ];

    public $timestamps = true;
    protected $dates = ['ngaysinh', 'ngaytao'];
    protected $hidden = ['password'];

    // Nếu cột lưu mật khẩu không phải là "password", thêm phương thức sau:
    public function getAuthPassword()
    {
        return $this->password; // Nếu tên cột mật khẩu là khác, cập nhật đúng tên cột ở đây
    }
}
