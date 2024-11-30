<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'John',
                'login' => 'john123@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'player',
                'photo' => null,
                'club_id' => null,
                'new_account' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane',
                'login' => 'janesmith@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'player',
                'photo' => null,
                'club_id' => null,
                'new_account' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Radoslaw',
                'login' => 'radoslaw.bujny@student.put.poznan.pl',
                'password' => Hash::make('password'),
                'role' => 'player',
                'photo' => null,
                'club_id' => null,
                'new_account' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
