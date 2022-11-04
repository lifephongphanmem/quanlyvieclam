<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTonghopdanhsachcungldCtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tonghopdanhsachcungld_ct', function (Blueprint $table) {
            $table->id();
            $table->string('math')->nullable();
            $table->string('ma_ngld')->nullable();
            $table->string('madb')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tonghopdanhsachcungld_ct');
    }
}
