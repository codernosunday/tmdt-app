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
        Schema::create('danhmucsanpham', function (Blueprint $table) {
            $table->increments('id_dm');

            // Các cột khác
            $table->string('tendanhmuc')->nullable();
            $table->string('trangthai')->nullable();
            $table->string('ghichu')->nullable();
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
        //
        Schema::dropIfExists('danhmucsanpham');
    }
};
