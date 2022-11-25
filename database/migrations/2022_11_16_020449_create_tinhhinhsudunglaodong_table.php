<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTinhhinhsudunglaodongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tinhhinhsudunglaodong', function (Blueprint $table) {
            $table->id();
            $table->string('matb')->nullable();
            $table->string('mathsdld')->nullable();
            $table->string('madv')->nullable();
            $table->string('nam')->nullable();
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
        Schema::dropIfExists('tinhhinhsudunglaodong');
    }
}
