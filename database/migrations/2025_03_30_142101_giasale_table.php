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
        Schema::create('giasale', function (Blueprint $table) {
            $table->increments('id_giasale');
            $table->unsignedInteger('id_giaban')->nullable();
            $table->unsignedInteger('id_sp')->nullable();
            $table->unsignedInteger('id_dm')->nullable();
            $table->unsignedInteger('id_ctdm')->nullable();
            $table->unsignedInteger('id_ctsp')->nullable();
            $table->decimal('giasale', 12, 3)->nullable();;
            $table->timestamp('ketthuc')->nullable();
            $table->timestamps();
            $table->foreign('id_dm')
                ->references('id_dm')
                ->on('danhmucsanpham')
                ->onDelete('cascade');
            $table->foreign('id_ctdm')
                ->references('id_ctdm')
                ->on('bangdanhmuc')
                ->onDelete('cascade');
            $table->foreign('id_sp')
                ->references('id_sp')
                ->on('sanpham')
                ->onDelete('cascade');
            $table->foreign('id_ctsp')
                ->references('id_ctsp')
                ->on('chitietsanpham');
            $table->foreign('id_giaban')
                ->references('id_giaban')
                ->on('giaban');
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
    }
};
