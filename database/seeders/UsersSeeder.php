<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'testing@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('testing'),
            'role' => 'admin',
            'avatar' => null, 
            'token_id' => null,
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Seller',
            'email' => 'seller@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('seller'),
            'role' => 'seller',
            'avatar' => null, 
            'token_id' => null,
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
