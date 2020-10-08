<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
            'matric_number' => '17/0672',
            'degree' => 1,
            'user_id' => 1,
            'created_at' => now(), 
            'updated_at' => now()
        ]);
    }
}
