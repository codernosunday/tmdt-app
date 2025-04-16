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
        Schema::create('giaban', function (Blueprint $table) {
            $table->increments('id_giaban');
            $table->unsignedInteger('id_sp')->nullable();
            $table->unsignedInteger('id_giasale')->nullable();
            $table->boolean('sale')->nullable();
            $table->decimal('giaban', 12, 2)->nullable();
            $table->decimal('giabanmoi', 12, 2)->nullable();
            $table->unsignedInteger('id_ctsp')->nullable();
            $table->timestamps();
            $table->foreign('id_ctsp')
                ->references('id_ctsp')
                ->on('chitietsanpham')
                ->onDelete('cascade');
            $table->foreign('id_sp')
                ->references('id_sp')
                ->on('sanpham')
                ->onDelete('cascade');
            $table->foreign('id_giasale')
                ->references('id_giasale')
                ->on('giasale')
                ->onDelete('no action');
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
        Schema::dropIfExists('giaban');
    }
};
