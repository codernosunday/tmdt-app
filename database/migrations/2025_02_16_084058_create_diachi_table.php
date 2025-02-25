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
        Schema::create('diachi', function (Blueprint $table) {
            // Khóa chính
            $table->increments('id_dchi');
            // Khóa ngoại tham chiếu bảng nguoidung
            $table->unsignedInteger('id_nd');
            // Các cột khác
            $table->text('ghichu')->nullable();
            $table->text('diachi1')->nullable();
            $table->text('diachi2')->nullable();
            $table->string('quocgia')->nullable();
            $table->string('tinh')->nullable();
            $table->string('huyen')->nullable();
            $table->string('xa')->nullable();
            $table->string('soDT', 10)->nullable();
            $table->date('ngaytao')->nullable();

            // Ràng buộc foreign key
            $table->foreign('id_nd')
                ->references('id_nd')
                ->on('nguoidung')
                ->onDelete('cascade');
            // onDelete('cascade') = xóa user sẽ xóa luôn địa chỉ liên quan
            // Nếu muốn có created_at & updated_at:
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
        Schema::dropIfExists('diachi');
    }
};
