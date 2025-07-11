<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          DB::table('users')->insert([
    [
        'username' => 'vitovit',
        'email' => 'adyatmavincencius@gmail.com',
        'phone_number' => '081234567890',
        'address' => 'Alamat bebas',
        'birthdate' => '2004-02-09', // 🎂 tanggal lahir ditambahkan
        'password' => bcrypt('password123'),
        'status' => 'pending'
    ],
    [
        'username' => 'reva',
        'email' => 'reva@gmail.com',
        'phone_number' => '081234567890',
        'address' => 'Alamat bebas',
        'birthdate' => '2005-06-21',
        'password' => bcrypt('password123'),
        'status' => 'pending'
    ],
    [
        'username' => 'ferly123',
        'email' => 'ferli@gmail.com',
        'phone_number' => '081234567890',
        'address' => 'Alamat bebas',
        'birthdate' => '2003-11-10',
        'password' => bcrypt('password123'),
        'status' => 'pending'
    ],
    [
        'username' => 'admin',
        'email' => 'admin@gmail.com',
        'phone_number' => '081234567890',
        'address' => 'Alamat bebas',
        'birthdate' => '2000-01-01',
        'password' => bcrypt('admin123'),
        'status' => 'active'
    ]
]);


        // Insert roles for users
        DB::table('role_ownerships')->insert([
            [
                'user_id' => 1,
                'role_id' => 2,
            ],
            [
                'user_id' => 2,
                'role_id' => 2,
            ],
               [
                'user_id' => 3,
                'role_id' => 2,
            ],
            [
                'user_id' => 4,
                'role_id' => 1,
            ],
        ]);
    }
}
