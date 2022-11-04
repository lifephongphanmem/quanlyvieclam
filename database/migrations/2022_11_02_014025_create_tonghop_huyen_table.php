<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTonghopHuyenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tonghop_huyen', function (Blueprint $table) {
            $table->id();
            $table->string('math')->nullable();
            $table->string('matb')->nullable();
            $table->string('noidung')->nullable();
            $table->string('madv')->nullable();
            $table->string('madvbc')->nullable();
            $table->string('madvcq')->nullable();
            $table->string('ngaygui')->nullable();
            $table->string('nguoigui')->nullable();
            $table->string('trangthai')->nullable();
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
        Schema::dropIfExists('tonghop_huyen');
    }
}
