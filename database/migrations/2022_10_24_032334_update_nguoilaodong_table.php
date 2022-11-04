<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNguoilaodongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nguoilaodong', function (Blueprint $table) {
            $table->string('thuongtru')->nullable();
            $table->string('tamtru')->nullable();
            $table->string('doituonguutien')->nullable();
            $table->string('cvhientai')->nullable();
            $table->string('vithevl')->nullable();
            $table->string('thatnghiep')->nullable();
            $table->string('thoigianthatnghiep')->nullable();
            $table->string('lydoktg')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nguoilaodong', function (Blueprint $table) {
            //
        });
    }
}
