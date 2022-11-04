<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDmtinhtrangthamgiahdkt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dmtinhtrangthamgiahdkt', function (Blueprint $table) {
            $table->id();
            $table->string('madmtgkt')->nullable();
            $table->string('tentgkt')->nullable();
            $table->string('trangthai')->nullable();
            $table->string('mota')->nullable();
            $table->integer('stt')->nullable();
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
        Schema::dropIfExists('dmtinhtrangthamgiahdkt');
    }
}
