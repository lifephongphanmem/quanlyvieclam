<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateThongbaocungldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('thongbaocungld', function (Blueprint $table) {
            $table->string('ngaygui')->default(0)->comment('0:chuagui');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('thongbaocungld', function (Blueprint $table) {
            //
        });
    }
}
