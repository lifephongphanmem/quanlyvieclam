<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTonghoplaodongnuocngoaiCtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tonghoplaodongnuocngoai_ct', function (Blueprint $table) {
            $table->id();
            $table->string('math')->nullable();
            $table->string('nam',50)->nullable();
            $table->string('hoten')->nullable();
            $table->string('ngaysinh')->nullable();
            $table->string('cmnd')->nullable();
            $table->string('ngaycapcmnd')->nullable();
            $table->string('giaypheplaodong')->nullable();
            $table->string('ngaycapgiaypheplaodong')->nullable();
            $table->string('trinhdo')->nullable();
            $table->string('quoctich')->nullable();
            $table->string('vitricongviec')->nullable();
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
        Schema::dropIfExists('tonghoplaodongnuocngoai_ct');
    }
}
