<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateThongbaotinhhinhsudunglaodongTableAddColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('thongbaotinhhinhsudungld', function (Blueprint $table) {
            $table->string('filequyetdinh')->nullable();
            $table->string('filekhac')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('thongbaotinhhinhsudungld', function (Blueprint $table) {
            //
        });
    }
}
