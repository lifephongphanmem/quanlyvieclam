<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNhucautuyendung extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nhucautuyendung', function (Blueprint $table) {
            $table->id();
            $table->string('mahs')->nullable();
            $table->string('madn')->nullable();
            $table->string('noidung')->nullable();
            $table->string('ten')->nullable();
            $table->string('sdt')->nullable();
            $table->string('email')->nullable();
            $table->string('yeucau')->nullable();
            $table->string('trangthai')->nullable();
            $table->string('lydo')->nullable();
            $table->string('nam')->nullable();
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
        Schema::dropIfExists('nhucautuyendung');
    }
}
