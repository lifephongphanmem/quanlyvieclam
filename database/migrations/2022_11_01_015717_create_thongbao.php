<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThongbao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thongbao', function (Blueprint $table) {
            $table->id();
            $table->string('manguoigui')->nullable();
            $table->string('matttd')->nullable();
            $table->string('matb')->nullable();
            $table->string('noidung')->nullable();
            $table->string('thoidiem')->nullable();
            $table->string('trangthai')->nullable();
            $table->string('filequyetdinh')->nullable();
            $table->string('filekhac')->nullable();
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
        Schema::dropIfExists('thongbao');
    }
}
