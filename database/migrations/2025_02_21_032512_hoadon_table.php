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
            $table->unsignedInteger('id_phi')->nullable();
            $table->unsignedInteger('id_hinhthuc')->nullable();
            $table->decimal('tontien', 20, 2)->nullable();
            $table->string('hoten');
            $table->string('email');
            $table->string('sodt', 10);
            $table->string('madonhang', 10)->unique();
            $table->string('trangthaidonhang')->nullable();
            $table->string('hinhthucthanhtoan')->nullable();
            $table->string('noidungchuyenkhoan')->nullable();
            $table->string('diachigiaohang');
            $table->string('ghichu')->nullable();
            $table->timestamps();
            $table->foreign('id_nd')
                ->references('id_nd')
                ->on('nguoidung')
                ->onDelete('cascade');
            $table->foreign('id_phi')
                ->references('id_phi')
                ->on('phivanchuyen')
                ->onDelete('no action');
            $table->foreign('id_hinhthuc')
                ->references('id_hinhthuc')
                ->on('hinhthucthanhtoan')
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
        Schema::dropIfExists('hoadon');
    }
};
