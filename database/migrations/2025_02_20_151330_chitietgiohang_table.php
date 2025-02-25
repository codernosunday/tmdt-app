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
        Schema::create('chitietgiohang', function (Blueprint $table) {
            $table->increments('id_ctgh');
            $table->unsignedInteger('id_ctsp');
            $table->unsignedInteger('id_giohang');
            $table->unsignedInteger('id_sp');
            $table->integer('soluong');
            $table->timestamps();
            $table->foreign('id_ctsp')
                ->references('id_ctsp')
                ->on('chitietsanpham')
                ->onDelete('cascade');
            $table->foreign('id_giohang')
                ->references('id_giohang')
                ->on('giohang')
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
        Schema::dropIfExists('chitietgiohang');
        //
    }
};
