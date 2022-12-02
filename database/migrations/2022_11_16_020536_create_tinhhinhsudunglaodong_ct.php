<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTinhhinhsudunglaodongCt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tinhhinhsudunglaodong_ct', function (Blueprint $table) {
            $table->id();
            $table->string('matb')->nullable();
            $table->string('mathsdld')->nullable();
            $table->string('madv')->nullable();
            $table->string('ngaygui')->nullable();
            $table->string('nam')->nullable();
            $table->string('mangld')->nullable();
            $table->string('hoten')->nullable();
            $table->string('sobhxh')->nullable();
            $table->string('bdbhxh')->nullable();
            $table->string('ktbhxh')->nullable();
            $table->string('ngaysinh')->nullable();
            $table->string('chucvu')->nullable();
            $table->string('vitrivl')->nullable();
            $table->string('mucluong')->nullable();
            $table->string('pcchucvu')->nullable();
            $table->string('pcthamnien')->nullable();
            $table->string('pcthamniennghe')->nullable();
            $table->string('pcluong')->nullable();
            $table->string('pcbosung')->nullable();
            $table->string('bddochai')->nullable();
            $table->string('ktdochai')->nullable();
            $table->string('loaihdld')->nullable();
            $table->string('bdhdld')->nullable();
            $table->string('kthdld')->nullable();
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
        Schema::dropIfExists('tinhhinhsudunglaodong-ct');
    }
}
