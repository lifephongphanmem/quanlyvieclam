<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNguoilaodongTableV4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nguoilaodong', function (Blueprint $table) {
            $table->string('sohc')->nullable();
            $table->string('ngaycapsohc')->nullable();
            $table->string('trinhdo')->nullable();
            $table->string('chuyenmondaotao')->nullable();
            $table->string('sogpld')->nullable();
            $table->string('ngaycapsogpld')->nullable();
            $table->string('nghecongviec')->nullable();
            $table->string('tendn')->nullable();
            $table->string('diachidn')->nullable();
            $table->string('loaidn')->nullable();
            $table->string('bdcv')->nullable();
            $table->string('ktcv')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nguoilaodong', function (Blueprint $table) {
            //
        });
    }
}
