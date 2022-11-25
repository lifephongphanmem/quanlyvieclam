<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCacBangCungld extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('thongbaocungld', function (Blueprint $table) {
            $table->string('nam')->nullable()->after('id');
        });
        Schema::table('tonghopdanhsachcungld', function (Blueprint $table) {
            $table->string('nam')->nullable()->after('id');
        });
        Schema::table('tonghopcungld_huyens', function (Blueprint $table) {
            $table->string('nam')->nullable()->after('id');
        });
        Schema::table('tonghopcungld_tinh', function (Blueprint $table) {
            $table->string('nam')->nullable()->after('id');
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
