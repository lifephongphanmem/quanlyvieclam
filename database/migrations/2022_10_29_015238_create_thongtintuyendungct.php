<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThongtintuyendungct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thongtintuyendungct', function (Blueprint $table) {
            $table->id();
            $table->string('mahs')->nullable();
            $table->string('manhom')->nullable();
            $table->string('madn')->nullable();
            $table->string('noidung')->nullable();
            $table->string('trangthai')->nullable();
            $table->string('thoidiemtu')->nullable();
            $table->string('thoidiemden')->nullable();
            $table->string('soluong')->nullable();
            $table->string('lydo')->nullable();
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
        Schema::dropIfExists('thongtintuyendungct');
    }
}
