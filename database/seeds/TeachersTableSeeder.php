<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teachers')->insert([
            'user_id' => 2,
            'phone_number' => '08121838482',
            'created_at' => now(), 
            'updated_at' => now()
        ]);
    }
}
