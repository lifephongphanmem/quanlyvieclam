<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTinhhinhsudunglaodongCtTableV1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tinhhinhsudunglaodong_ct', function (Blueprint $table) {
            $table->string('tieude')->nullable()->after('madv');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tinhhinhsudunglaodong_ct', function (Blueprint $table) {
            //
        });
    }
}
