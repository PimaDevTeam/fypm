<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'test@gmail.com',
            'role_id' => 1,
            'phone_number' => '0802332421',
            'password' => Hash::make('admin'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        // DB::table('users')->insert([
        //     'first_name' => 'Stephen',
        //     'last_name' => 'Adams',
        //     'email' => 'stephen@gmail.com',
        //     'role_id' => 3,
        //     'phone_number' => '08101180342',
        //     'password' => Hash::make('password'),
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);
    }
}
