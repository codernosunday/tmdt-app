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
        Schema::create('hinhthucthanhtoan', function (Blueprint $table) {
            $table->increments('id_hinhthuc');
            $table->string('tenhinhthuc')->nullable();
            $table->string('sodt')->nullable();
            $table->string('sotk')->nullable();
            $table->string('nganhang')->nullable();
            $table->string('tenchu')->nullable();
            $table->string('QRcode')->nullable();
            $table->string('khac')->nullable();
            $table->timestamps();
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
