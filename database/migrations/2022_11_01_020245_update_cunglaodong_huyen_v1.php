<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCunglaodongHuyenV1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tonghopcungld_huyens', function (Blueprint $table) {
            $table->string('madvbc')->nullable();
            $table->string('madvcq')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tonghopcungld_huyens', function (Blueprint $table) {
            //
        });
    }
}