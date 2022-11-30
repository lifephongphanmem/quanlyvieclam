<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'SSA',
            'username'=>'SSA',
            'password'=>md5('@pmcs123@!'),
            'sadmin'=>'SSA',
            'madv'=>'SSA',
            'phanloaitk'=>'SSA',
            'status'=>1
        ]);
    }
}
