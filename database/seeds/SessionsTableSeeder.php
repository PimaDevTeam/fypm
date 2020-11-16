<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SessionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sessions')->insert([
            'session' => '2017/2018'
        ]);
        DB::table('sessions')->insert([
            'session' => '2018/2019'
        ]);
        DB::table('sessions')->insert([
            'session' => '2019/2020'
        ]);
        DB::table('sessions')->insert([
            'session' => '2020/2021'
        ]);
    }
}
