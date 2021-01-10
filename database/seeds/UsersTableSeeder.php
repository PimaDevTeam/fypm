<?php

use App\Role;
use App\User;
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
        // DB::table('users')->insert([
        //     'first_name' => 'Super',
        //     'last_name' => 'Admin',
        //     'email' => 'test@gmail.com',
        //     'phone_number' => '0802332421',
        //     'session_id' => 1,
        //     'program_id' =>  1,
        //     'degree_id' => 1,
        //     'password' => Hash::make('admin'),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
        // DB::table('users')->insert([
        //     'first_name' => 'Stephen',
        //     'last_name' => 'Adams',
        //     'email' => 'stephen@gmail.com',
        //     'phone_number' => '08023427421',
        //     'session_id' => 1,
        //     'program_id' =>  1,
        //     'degree_id' => 1,
        //     'password' => Hash::make('password'),
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);
        // DB::table('users')->insert([
        //     'first_name' => 'Sabastine',
        //     'last_name' => 'Nwachukwu',
        //     'email' => 'sabastine@gmail.com',
        //     'phone_number' => '08102208213',
        //     'session_id' => 1,
        //     'program_id' =>  1,
        //     'degree_id' => 1,
        //     'password' => Hash::make('password'),
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);

        $roles = Role::all();
        factory(App\User::class, 50)
            ->create()->each(function ($user) use ($roles) { 
                $user->roles()->attach(4); 
            });;

        // Get all the roles
        // App\User::all()->each(function ($user) use ($roles) { 
        //     $user->roles()->attach(
        //         $roles->random(rand(3, 4))->pluck('id')->toArray()
        //     ); 
        // });
        // factory(App\User::class, 2)->create()->each(function ($a) {
        //     $a->roles()->attach(
        //         \App\Role::all()->random(rand(3,4))->pluck("id")
        //     );
        // });
    }
}
