<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        DB::table('users')->insert([
            'name'              => 'Admin User',
            'email'             => 'admin@example.com',
            'role'              => 'admin',
            'email_verified_at' => now(),
            'password'          => Hash::make('password'),
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        // Regular users
        $users = [
            ['name' => 'Alice Johnson',  'email' => 'alice@example.com'],
            ['name' => 'Bob Smith',      'email' => 'bob@example.com'],
            ['name' => 'Carol Williams','email' => 'carol@example.com'],
            ['name' => 'David Brown',   'email' => 'david@example.com'],
            ['name' => 'Eva Martinez',  'email' => 'eva@example.com'],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'name'              => $user['name'],
                'email'             => $user['email'],
                'role'              => 'user',
                'email_verified_at' => now(),
                'password'          => Hash::make('password'),
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);
        }
    }
}
