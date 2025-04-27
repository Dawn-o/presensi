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
                'email' => 'admin@kostungu.com',
                'password' => 'password123',
                'is_admin' => true,
            ],
            [
                'name' => 'Muhammad Rushelasli',
                'employee_id' => '025001',
                'email' => 'rushelasli@kostungu.com',
                'password' => 'password123',
                'is_admin' => false,
            ],
            [
                'name' => 'Mohammad Agung Dwi Mardika',
                'employee_id' => '025002',
                'email' => 'agung@kostungu.com',
                'password' => 'password123',
                'is_admin' => false,
            ],
            [
                'name' => 'Muhammad Awla Ridhani',
                'employee_id' => '025003',
                'email' => 'awla@kostungu.com',
                'password' => 'password123',
                'is_admin' => false,
            ],
            [
                'name' => 'Najmi Fathony',
                'employee_id' => '025004',
                'email' => 'najmi@kostungu.com',
                'password' => 'password123',
                'is_admin' => false,
            ],
            [
                'name' => 'Dhimas Anjar Dhery Jhovan',
                'employee_id' => '025005',
                'email' => 'dhimas@kostungu.com',
                'password' => 'password123',
                'is_admin' => false,
            ],
            [
                'name' => 'Muhammad Rizki Ananda Putra',
                'employee_id' => '025006',
                'email' => 'rizki@kostungu.com',
                'password' => 'password123',
                'is_admin' => false,
            ],
            [
                'name' => 'Riyan Dwi Cahyadi',
                'employee_id' => '025007',
                'email' => 'riyan@kostungu.com',
                'password' => 'password123',
                'is_admin' => false,
            ],
            [
                'name' => 'Muhammad Zidane',
                'employee_id' => '025008',
                'email' => 'zidane@kostungu.com',
                'password' => 'password123',
                'is_admin' => false,
            ],
            [
                'name' => 'Muhammad Royyan',
                'employee_id' => '025009',
                'email' => 'royyan@kostungu.com',
                'password' => 'password123',
                'is_admin' => false,
            ],
            [
                'name' => 'Alfandi Hassan',
                'employee_id' => '025010',
                'email' => 'alfandi@kostungu.com',
                'password' => 'password123',
                'is_admin' => false,
            ],
            [
                'name' => 'Muhammad Alfaro Muda Harahap',
                'employee_id' => '025011',
                'email' => 'alfaro@kostungu.com',
                'password' => 'password123',
                'is_admin' => false,
            ],
            [
                'name' => 'Firdaus Depa Ardhana',
                'employee_id' => '025012',
                'email' => 'alfaro@kostungu.com',
                'password' => 'password123',
                'is_admin' => false,
            ],
            [
                'name' => 'Muhammad Aldy Febriwafi Munawwar',
                'employee_id' => '025013',
                'email' => 'alfaro@kostungu.com',
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
