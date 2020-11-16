<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('programs')->insert([
            'program' => 'Anatomy',
            'program_code' => 'ANAT',
            'department_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('programs')->insert([
            'program' => 'Computer Science',
            'program_code' => 'COMP',
            'department_id' => 3,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('programs')->insert([
            'program' => 'Computer Science (Technology)',
            'program_code' => 'COMT',
            'department_id' => 3,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('programs')->insert([
            'program' => 'Software Engineering',
            'program_code' => 'SENG',
            'department_id' => 4,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
