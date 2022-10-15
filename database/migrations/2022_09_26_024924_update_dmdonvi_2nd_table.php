<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDmdonvi2ndTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dmdonvi', function (Blueprint $table) {
            $table->string('diadanh')->nullable();
            $table->string('chucvuky')->nullable();
            $table->string('nguoiky')->nullable();
            $table->string('ttlienhe')->nullable();
            $table->string('tendvhienthi')->nullable()->after('tendv');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dmdonvi', function (Blueprint $table) {
            //
        });
    }
}
