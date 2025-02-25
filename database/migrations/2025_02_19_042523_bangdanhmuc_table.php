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
        Schema::create('bangdanhmuc', function (Blueprint $table) {
            $table->increments('id_ctdm');
            $table->unsignedInteger('id_dm');
            // Các cột khác
            $table->string('ten')->nullable();
            $table->string('ghichu')->nullable();
            // created_at & updated_at:
            $table->timestamps();
            //
            $table->foreign('id_dm')
                ->references('id_dm')
                ->on('danhmucsanpham')
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
        Schema::dropIfExists('bangdanhmuc');
    }
};
