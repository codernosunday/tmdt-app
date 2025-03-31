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
        Schema::create('chitietsanpham', function (Blueprint $table) {
            $table->increments('id_ctsp');
            $table->unsignedInteger('id_sp');
            $table->unsignedInteger('id_thuoctinh')->nullable();
            $table->float('chieurong')->nullable();
            $table->float('chieucao')->nullable();
            $table->float('doday')->nullable();
            $table->integer('soluong')->nullable();
            $table->integer('sotrang')->nullable();
            $table->string('tenchitiet')->nullable();
            $table->string('thuonghieu')->nullable();
            $table->string('xuatsu')->nullable();
            $table->string('sanxuat')->nullable();
            $table->string('khuyencao')->nullable();
            $table->string('mausac')->nullable();
            $table->string('mamau')->nullable();
            $table->text('anhsp')->nullable();
            $table->string('dattinh', 500)->nullable();
            $table->timestamps();
            $table->foreign('id_sp')
                ->references('id_sp')
                ->on('sanpham')
                ->onDelete('cascade');
            $table->foreign('id_thuoctinh')
                ->references('id_thuoctinh')
                ->on('thuoctinhsanpham')
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
        Schema::dropIfExists('chitietsanpham');
        //
    }
};
