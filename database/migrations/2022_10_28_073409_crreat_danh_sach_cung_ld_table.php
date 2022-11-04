<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrreatDanhSachCungLdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tonghopdanhsachcungld', function (Blueprint $table) {
            $table->id();
            $table->string('noidung')->nullable();
            $table->string('math')->nullable();
            $table->string('matb')->nullable();
            $table->string('trangthai')->nullable();
            $table->string('ngaygui')->nullable();
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
        Schema::dropIfExists('tonghopdanhsachcungld');
    }
}
