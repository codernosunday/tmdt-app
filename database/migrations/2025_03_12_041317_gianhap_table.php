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
        Schema::create('gianhap', function (Blueprint $table) {
            $table->increments('id_gianhap');
            $table->unsignedInteger('id_sp');
            $table->unsignedInteger('id_nhacungcap')->nullable();
            $table->float('gianhap')->nullable();
            $table->integer('soluong')->nullable();
            $table->timestamps();
            $table->foreign('id_nhacungcap')
                ->references('id_nhacungcap')
                ->on('nhacungcap')
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
        Schema::dropIfExists('gianhap');
    }
};
