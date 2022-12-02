<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTinhhinhsudunglaodongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tinhhinhsudunglaodong', function (Blueprint $table) {
            $table->string('tieude')->nullable()->after('matb');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tinhhinhsudunglaodong', function (Blueprint $table) {
            //
        });
    }
}
