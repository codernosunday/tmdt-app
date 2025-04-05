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
        Schema::create('binhluan', function (Blueprint $table) {
            $table->increments('id_bl');
            $table->unsignedInteger('id_sp')->nullable();
            $table->unsignedInteger('id_nd')->nullable();
            $table->unsignedInteger('id_ctsp')->nullable();
            $table->float('sosao')->nullable();
            $table->string('danhgia')->nullable();
            $table->string('noidungbinhluan')->nullable();
            $table->timestamps();

            $table->foreign('id_sp')
                ->references('id_sp')
                ->on('sanpham')
                ->onDelete('cascade');
            $table->foreign('id_nd')
                ->references('id_nd')
                ->on('nguoidung')
                ->onDelete('cascade');
            $table->foreign('id_ctsp')
                ->references('id_ctsp')
                ->on('chitietsanpham')
                ->onDelete('cascade');
        });
        //
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
