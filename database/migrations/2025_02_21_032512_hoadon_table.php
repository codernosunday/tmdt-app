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
        Schema::create('hoadon', function (Blueprint $table) {
            $table->increments('id_hoadon');
            $table->unsignedInteger('id_nd');
            $table->float('tongtien');
            $table->string('hoten');
            $table->string('sodt', 10);
            $table->string('madonhang', 10)->unique();
            $table->string('diachigiaohang');
            $table->string('ghichu')->nullable();
            $table->timestamps();
            $table->foreign('id_nd')
                ->references('id_nd')
                ->on('nguoidung')
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
        Schema::dropIfExists('hoadon');
    }
};
