<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
        public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Admin',
            'employee_id' => '001',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password123'),
            'is_admin' => true,
        ]);
    }
}
