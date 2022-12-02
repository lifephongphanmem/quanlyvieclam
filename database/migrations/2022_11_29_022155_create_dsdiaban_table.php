<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDsdiabanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dsdiaban', function (Blueprint $table) {
            $table->id();
            $table->string('madiaban')->unique();
            $table->string('tendiaban')->nullable();
            $table->string('capdo')->nullable();//ADMIN; T; H; X
            $table->text('ghichu')->nullable();
            $table->string('madonviQL')->nullable();
            $table->string('madiabanQL')->nullable();
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
        Schema::dropIfExists('dsdiaban');
    }
}
