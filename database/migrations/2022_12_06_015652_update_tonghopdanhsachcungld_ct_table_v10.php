<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTonghopdanhsachcungldCtTableV10 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tonghopdanhsachcungld_ct', function (Blueprint $table) {
            $table->string('nam',50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tonghopdanhsachcungld_ct', function (Blueprint $table) {
            //
        });
    }
}
