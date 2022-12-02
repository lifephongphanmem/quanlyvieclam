<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThongbaoTinhhinhsdldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thongbaotinhhinhsudungld', function (Blueprint $table) {
            $table->id();
            $table->string('matb')->nullable();
            $table->string('nam')->nullable();
            $table->string('tieude')->nullable();
            $table->string('noidung')->nullable();
            $table->string('hannop')->nullable();
            $table->string('trangthai')->nullable();
            $table->string('ngaygui')->nullable();
            $table->string('nguoigui')->nullable();
            $table->timestamps();
        });
        Schema::create('thongbaotinhhinhsudungld_doanhnghiep', function (Blueprint $table) {
            $table->id();
            $table->string('matb')->nullable();
            $table->string('masodn')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thongbaotinhhinhsudungld');
    }
}
