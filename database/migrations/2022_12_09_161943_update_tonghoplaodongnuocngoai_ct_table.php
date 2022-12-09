<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTonghoplaodongnuocngoaiCtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tonghoplaodongnuocngoai_ct', function (Blueprint $table) {
            $table->string('gioitinh')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tonghoplaodongnuocngoai_ct', function (Blueprint $table) {
            //
        });
    }
}
