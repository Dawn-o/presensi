<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'employee_id' => '001',
                'email' => 'admin@gmail.com',
                'password' => 'password123',
                'is_admin' => true,
            ],
            [
                'name' => 'Herman Setiawan',
                'employee_id' => '025001',
                'email' => 'herman@gmail.com',
                'password' => 'password123',
                'is_admin' => false,
            ],
            [
                'name' => 'Budi Santoso',
                'employee_id' => '025002',
                'email' => 'budi@gmail.com',
                'password' => 'password123',
                'is_admin' => false,
            ],
            [
                'name' => 'Ani Wijaya',
                'employee_id' => '025003',
                'email' => 'ani@gmail.com',
                'password' => 'password123',
                'is_admin' => false,
            ],
            [
                'name' => 'Dewi Kusuma',
                'employee_id' => '025004',
                'email' => 'dewi@gmail.com',
                'password' => 'password123',
                'is_admin' => false,
            ],
            [
                'name' => 'Eko Prasetyo',
                'employee_id' => '025005',
                'email' => 'eko@gmail.com',
                'password' => 'password123',
                'is_admin' => false,
            ],
            [
                'name' => 'Fitri Handayani',
                'employee_id' => '025006',
                'email' => 'fitri@gmail.com',
                'password' => 'password123',
                'is_admin' => false,
            ],
            [
                'name' => 'Gunawan Wibowo',
                'employee_id' => '025007',
                'email' => 'gunawan@gmail.com',
                'password' => 'password123',
                'is_admin' => false,
            ],
            [
                'name' => 'Hesti Putri',
                'employee_id' => '025008',
                'email' => 'hesti@gmail.com',
                'password' => 'password123',
                'is_admin' => false,
            ],
            [
                'name' => 'Irfan Hakim',
                'employee_id' => '025009',
                'email' => 'irfan@gmail.com',
                'password' => 'password123',
                'is_admin' => false,
            ],
            [
                'name' => 'Joko Susanto',
                'employee_id' => '025010',
                'email' => 'joko@gmail.com',
                'password' => 'password123',
                'is_admin' => false,
            ],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'employee_id' => $user['employee_id'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
                'is_admin' => $user['is_admin'],
            ]);
        }
    }
}