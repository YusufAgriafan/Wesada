<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        DB::table('token')->insert([
            [
                'no_token' => Str::random(12),
                'used' => 0,                    
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_token' => Str::random(12),
                'used' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_token' => Str::random(12),
                'used' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

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
