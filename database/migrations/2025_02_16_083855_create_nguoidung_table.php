<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nguoidung', function (Blueprint $table) {
            $table->increments('id_nd');

            // Các cột khác
            $table->string('hovaten')->nullable();
            $table->string('username', 50)->unique()->nullable(); // Username 50 ký tự, unique
            $table->string('password', 255);          // Password 50 ký tự
            $table->string('maxacnhan', 10);
            $table->date('ngaysinh')->nullable();
            $table->string('soDT', 10)->nullable();  // SĐT tối đa 10 ký tự
            $table->string('mail')->unique();
            $table->boolean('xacnhanmail')->nullable();
            $table->date('ngaytao')->nullable();
            $table->integer('solannhapsai')->nullable();
            $table->string('tinhtrantk')->nullable();
            $table->string('quyentruycap')->nullable();
            // created_at & updated_at:
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nguoidung');
    }
};
