<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTinhhinhsudungldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tinhhinhsudunglaodong', function (Blueprint $table) {
            $table->string('ngaygui')->nullable()->after('trangthai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tinhhinhsudungld', function (Blueprint $table) {
            //
        });
    }
}
