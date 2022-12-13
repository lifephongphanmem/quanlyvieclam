<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateThongbaocungldTableAddColumnThoigianđieutra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('thongbaocungld', function (Blueprint $table) {
            $table->date('tungay')->nullable();
            $table->date('denngay')->nullable();
        });

        Schema::table('tonghopdanhsachcungld', function (Blueprint $table) {
            $table->date('tungay')->nullable();
            $table->date('denngay')->nullable();
        });

        Schema::table('tonghopdanhsachcungld_ct', function (Blueprint $table) {
            $table->date('tungay')->nullable();
            $table->date('denngay')->nullable();
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
