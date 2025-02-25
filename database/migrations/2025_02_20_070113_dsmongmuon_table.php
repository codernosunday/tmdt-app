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
        Schema::create('dsmongmuon', function (Blueprint $table) {
            $table->increments('id_dsmm');
            $table->unsignedInteger('id_nd');
            $table->unsignedInteger('id_sp');
            $table->timestamps();
            $table->foreign('id_nd')
                ->references('id_nd')
                ->on('nguoidung')
                ->onDelete('cascade');

            $table->foreign('id_sp')
                ->references('id_sp')
                ->on('sanpham')
                ->onDelete('cascade');
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
        Schema::dropIfExists('dsmongmuon');
    }
};
