<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTonghopdanhsachcungldCtTableV2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tonghopdanhsachcungld_ct', function (Blueprint $table) {
            $table->string('dantoc')->nullable();
            $table->string('gioitinh')->nullable();
            $table->string('quocgia')->nullable();
            $table->string('sobaohiem')->nullable();
            $table->string('bdbhxh')->nullable();
            $table->string('ktbhxh')->nullable();
            $table->string('luongbhxh')->nullable();
            $table->string('trinhdogiaoduc')->nullable();
            $table->string('trinhdocmkt')->nullable();
            $table->string('nghenghiep')->nullable();
            $table->string('linhvucdaotao')->nullable();
            $table->string('loaihdld')->nullable();
            $table->string('bdhopdong')->nullable();
            $table->string('kthopdong')->nullable();
            $table->string('luong')->nullable();
            $table->string('pcchucvu')->nullable();
            $table->string('pcthamnien')->nullable();
            $table->string('pcthamniennghe')->nullable();
            $table->string('pcluong')->nullable();
            $table->string('pcbosung')->nullable();
            $table->string('bddochai')->nullable();
            $table->string('ktdochai')->nullable();
            $table->string('vitri')->nullable();
            $table->string('chucvu')->nullable();
            $table->string('ghichu')->nullable();
            $table->string('company')->nullable();
            $table->string('sate')->nullable();
            $table->string('thuongtru')->nullable();
            $table->string('tamtru')->nullable();
            $table->string('doituonguutien')->nullable();
            $table->string('cvhientai')->nullable();
            $table->string('vithevl')->nullable();
            $table->string('thatnghiep')->nullable();
            $table->string('thoigianthatnghiep')->nullable();
            $table->string('lydoktg')->nullable();
            $table->string('tinhtrangvl')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tonghopdanhsachcungld_ct', function (Blueprint $table) {
            //
        });
    }
}
