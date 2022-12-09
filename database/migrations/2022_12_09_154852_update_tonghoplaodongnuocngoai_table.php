<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTonghoplaodongnuocngoaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tonghoplaodongnuocngoai', function (Blueprint $table) {
            $table->string('madv',50)->nullable();
        });
        Schema::table('tonghoplaodongnuocngoai_ct', function (Blueprint $table) {
            $table->string('madv',50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tonghoplaodongnuocngoai', function (Blueprint $table) {
            //
        });
    }
}
