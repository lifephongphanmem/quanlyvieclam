<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDubaonhucaulaodongChitietTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dubaonhucaulaodong_chitiet', function (Blueprint $table) {
            $table->id();
            $table->string('madubao')->nullable();
            $table->string('phanloai')->nullable();//Cung; Cầu; Khác
            //Thông tin cung
            $table->string('madonvi', 50)->nullable();
            $table->string('tendonvi',100)->nullable();            
            //Thông tin cầu
            $table->string('masodn', 50)->nullable();
            $table->string('tendv')->nullable();  
            //Thông tin nguồn điều tra khác
            $table->string('tennguon')->nullable();  
            //Vị trí việc làm (lấy theo bảng dmtinhtrangthamgiahdktct2)
            $table->string('madmtgktct2')->nullable();
            $table->string('tentgktct2')->nullable();
            $table->double('soluong')->default(0);
            $table->string('ghichu')->nullable();
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
        Schema::dropIfExists('dubaonhucaulaodong_chitiet');
    }
}
