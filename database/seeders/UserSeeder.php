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
            'user_name'     => 'admin',
            'user_email'    => 'admin@gmail.com',
            'user_level'    => 1,
            'user_pass'     => Hash::make('admin'),
            'role'          => 'admin',
        ]);
        DB::table('users')->insert([
            'user_name'     => 'user1',
            'user_email'    => 'user1@gmail.com',
            'user_level'    => 1,
            'user_pass'     => Hash::make('user1'),
            'role'          => 'user',
        ]);
    }
}
