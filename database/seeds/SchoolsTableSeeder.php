<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schools')->insert([
            'school' => 'Benjamin S. Carson School of Medicine',
            'school_code' => 'BCSM',
            'created_at' => now(),
            'updated_at' => now()

        ]);
        DB::table('schools')->insert([
            'school' => 'Computing and Engineering Sciences',
            'school_code' => 'CES',
            'created_at' => now(),
            'updated_at' => now()

        ]);
        DB::table('schools')->insert([
            'school' => 'College of Health and Medical Sciences',
            'school_code' => 'CHMS',
            'created_at' => now(),
            'updated_at' => now()

        ]);
        DB::table('schools')->insert([
            'school' => 'Education and Humanities',
            'school_code' => 'EAH',
            'created_at' => now(),
            'updated_at' => now()

        ]);
    }
}
