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
        Schema::create('thanhtoan', function (Blueprint $table) {
            $table->unsignedInteger('id_thanhtoan');
            $table->unsignedInteger('id_phi')->nullable();
            $table->string('trangthaidonhang');
            $table->string('hinhthucthanhtoan');
            $table->timestamps();
            $table->foreign('id_thanhtoan')
                ->references('id_hoadon')
                ->on('hoadon')
                ->onDelete('cascade');
            $table->foreign('id_phi')
                ->references('id_phi')
                ->on('phivanchuyen')
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
        Schema::dropIfExists('thanhtoan');
        //
    }
};
