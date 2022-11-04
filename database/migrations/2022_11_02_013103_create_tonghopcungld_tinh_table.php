<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTonghopcungldTinhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tonghopcungld_tinh', function (Blueprint $table) {
            $table->id();
            $table->string('math')->nullable();
            $table->string('noidung')->nullable();
            $table->string('madvbc')->nullable();
            $table->string('madv')->nullable();
            $table->string('matb')->nullable();
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
        Schema::dropIfExists('tonghopcungld_tinh');
    }
}
