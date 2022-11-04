<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThongtintuyendung extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thongtintuyendung', function (Blueprint $table) {
            $table->id();
            $table->string('matttd')->nullable();
            $table->string('tieude')->nullable();
            $table->string('mota')->nullable();
            $table->string('thoidiemtu')->nullable();
            $table->string('thoidiemden')->nullable();
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
        Schema::dropIfExists('thongtintuyendung');
    }
}
