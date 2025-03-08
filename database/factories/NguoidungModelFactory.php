<?php

namespace Database\Factories;

use App\Models\NguoidungModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class NguoidungModelFactory extends Factory
{
    protected $model = NguoidungModel::class; // Đổi từ Nguoidung::class thành NguoidungModel::class

    public function definition()
    {
        return [
            'hovaten' => $this->faker->name(),
            'username' => $this->faker->unique()->userName(),
            'password' => sha1('password'),
            'ngaysinh' => $this->faker->date(),
            'soDT' => $this->faker->numerify('098#######'),
            'mail' => $this->faker->unique()->safeEmail(),
            'ngaytao' => now(),
            'quyentruycap' => 'user',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
