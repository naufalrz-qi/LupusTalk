<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'username'     => 'admin',
            'email'    => 'admin@gmail.com',
            'user_level'    => 1,
            'password'     => Hash::make('admin'),
            'role'          => 'admin',
        ]);
        DB::table('users')->insert([
            'username'     => 'user1',
            'email'    => 'user1@gmail.com',
            'user_level'    => 1,
            'password'     => Hash::make('user1'),
            'role'          => 'user',
        ]);
    }
}
