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
        Schema::create('chitietmua', function (Blueprint $table) {
            $table->increments('id_ctm');
            $table->unsignedInteger('id_ctsp');
            $table->unsignedInteger('id_hoadon');
            $table->unsignedInteger('id_giasale');
            $table->integer('soluong');
            $table->decimal('thanhtien', 15, 1)->nullable();
            $table->timestamps();
            $table->foreign('id_ctsp')
                ->references('id_ctsp')
                ->on('chitietsanpham')
                ->onDelete('cascade');
            $table->foreign('id_hoadon')
                ->references('id_hoadon')
                ->on('hoadon')
                ->onDelete('cascade');
            $table->foreign('id_giasale')
                ->references('id_giasale')
                ->on('giasale');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chitietmua');
    }
};
