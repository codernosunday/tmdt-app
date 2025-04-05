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
        //
        Schema::create('sanpham', function (Blueprint $table) {
            $table->increments('id_sp');
            $table->unsignedInteger('id_ctdm');
            $table->string('tensp')->nullable();
            $table->string('anh')->nullable();
            $table->text('tomtatsp')->nullable();
            $table->boolean('tinhtrang')->nullable();
            $table->boolean('trangthai')->nullable();
            $table->timestamps();
            $table->foreign('id_ctdm')
                ->references('id_ctdm')
                ->on('bangdanhmuc')
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
        Schema::dropIfExists('sanpham');
    }
};
