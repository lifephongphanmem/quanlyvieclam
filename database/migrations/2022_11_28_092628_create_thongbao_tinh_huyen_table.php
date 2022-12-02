<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThongbaoTinhHuyenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thongbao_tinh_huyen', function (Blueprint $table) {
            $table->id();
            $table->string('matb')->nullable();
            $table->string('tieude')->nullable();
            $table->string('noidung')->nullable();
            $table->string('thoigiangui')->nullable();
            $table->string('trangthai')->nullable();
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
        Schema::dropIfExists('thongbao_tinh_huyen');
    }
}
