<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            'department' => 'Anatomy',
            'department_code' => 'ANAT',
            'school_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'department' => 'Biochemistry',
            'department_code' => 'BCHM',
            'school_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'department' => 'Computer Science',
            'department_code' => 'COSC',
            'school_id' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'department' => 'Software Engineering',
            'department_code' => 'SENG',
            'school_id' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
