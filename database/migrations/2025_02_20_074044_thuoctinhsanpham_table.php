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
        Schema::create('thuoctinhsanpham', function (Blueprint $table) {
            $table->increments('id_thuoctinh');
            $table->string('loai')->nullable();
            $table->string('danhsachspgoiy')->nullable();
            $table->string('kichthuoc')->nullable();
            $table->string('mota')->nullable();
            $table->string('mau')->nullable();
            $table->string('mamau')->nullable();
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
        Schema::dropIfExists('thuoctinhsanpham');
        //
    }
};
