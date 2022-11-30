<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDanhmuchanhchinTableAddTruong extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('danhmuchanhchinh', function (Blueprint $table) {
            $table->string('capdo')->nullable();//ADMIN; T; H; X
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('danhmuchanhchinh', function (Blueprint $table) {
            //
        });
    }
}
