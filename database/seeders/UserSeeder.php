<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'fname' => 'admin',
            'lname' => 'account',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'is_admin' => 1,
            'password' => Hash::make('1234'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'fname' => 'user',
            'lname' => 'account',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'is_admin' => 0,
            'password' => Hash::make('1234'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
