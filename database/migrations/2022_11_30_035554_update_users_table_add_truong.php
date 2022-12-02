<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTableAddTruong extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('sadmin')->nullable();
            $table->integer('solandn')->default(1);
            $table->string('manhomchucnang')->nullable();
            $table->boolean('nhaplieu')->default(0);
            $table->boolean('tonghop')->default(0);
            $table->boolean('hethong')->default(0);
            $table->boolean('chucnangkhac')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
