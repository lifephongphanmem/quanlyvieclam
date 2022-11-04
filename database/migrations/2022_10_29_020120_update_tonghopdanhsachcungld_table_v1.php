<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTonghopdanhsachcungldTableV1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tonghopdanhsachcungld_ct', function (Blueprint $table) {
            $table->string('hoten')->nullable();
            $table->string('cmnd')->nullable();
            $table->string('ngaysinh')->nullable();
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
