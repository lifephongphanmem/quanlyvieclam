<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class dmdonvibaocaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $madvbc=getdate()[0];
        DB::table('dmdonvibaocao')->insert([
            'madvbc'=>$madvbc,
            'tendvbc'=>'Phần mềm cuộc sống',
            'level'=>'H'
        ]);
    }
}
