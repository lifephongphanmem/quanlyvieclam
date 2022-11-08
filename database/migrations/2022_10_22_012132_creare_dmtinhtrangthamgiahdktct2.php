<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreareDmtinhtrangthamgiahdktct2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dmtinhtrangthamgiahdktct2', function (Blueprint $table) {
            $table->id();
            $table->string('manhom2')->nullable();
            $table->string('madmtgktct2')->nullable();
            $table->string('tentgktct2')->nullable();
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
        //
    }
}
