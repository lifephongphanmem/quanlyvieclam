<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNhucautuyendungct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nhucautuyendungct', function (Blueprint $table) {
            $table->id();
            $table->string('mahs')->nullable();
            $table->string('tencongviec')->nullable();
            $table->string('dotuoi')->nullable();
            $table->string('vitrivl')->nullable();
            $table->string('soluong')->nullable();
            $table->string('soluongnu')->nullable();
            $table->string('mota')->nullable();
            $table->string('tdvanhoa')->nullable();
            $table->string('tdkythuat')->nullable();
            $table->string('chuyennganh')->nullable();
            $table->string('tdtinhoc')->nullable();
            $table->string('tdngoaingu')->nullable();
            $table->string('kynangmem')->nullable();
            $table->string('kinhnghiem')->nullable();
            $table->string('noilamviec')->nullable();
            $table->string('luong')->nullable();
            $table->string('hotroan')->nullable();
            $table->string('phucloikhac')->nullable();
            $table->string('nam')->nullable();
            $table->string('xd')->nullable();
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
        Schema::dropIfExists('nhucautuyendungct');
    }
}
