<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        // ───────────────────────────────────
        // 1.  DATA USER
        // ───────────────────────────────────
        // 2 akun ADMIN (pending) + 3 akun SUPER‑ADMIN (active)
        DB::table('users')->insert([
            // ── ADMIN (pending)
            [
                'username'     => 'vitovit',                       // Vito
                'email'        => 'adyatmavincencius@gmail.com',
                'phone_number' => '081234567890',
                'address'      => 'Alamat Vito di Parangan',
                'birthdate'    => '2004-02-09',
                'password'     => Hash::make('password123'),
                'status'       => 'pending',
            ],
            [
                'username'     => 'reva',                          // Teman Vito
                'email'        => 'reva@gmail.com',
                'phone_number' => '081234567891',
                'address'      => 'Alamat Reva di Parangan',
                'birthdate'    => '2005-06-21',
                'password'     => Hash::make('password123'),
                'status'       => 'pending',
            ],

            // ── SUPER‑ADMIN (active)
            [
                'username'     => 'adminparangan',
                'email'        => 'adminparangan@gmail.com',
                'phone_number' => '081200000001',
                'address'      => 'Kantor Dusun Parangan',
                'birthdate'    => '2000-01-01',
                'password'     => Hash::make('superadmin123'),
                'status'       => 'active',
            ],
            [
                'username'     => 'parangangayamharjo',
                'email'        => 'parangangayamharjo@gmail.com',
                'phone_number' => '081200000002',
                'address'      => 'Gayamharjo, Prambanan',
                'birthdate'    => '2000-01-02',
                'password'     => Hash::make('superadmin123'),
                'status'       => 'active',
            ],
            [
                'username'     => 'timkknparangan',
                'email'        => 'timkknparangan@gmail.com',
                'phone_number' => '081200000003',
                'address'      => 'Posko KKN Parangan',
                'birthdate'    => '2000-01-03',
                'password'     => Hash::make('superadmin123'),
                'status'       => 'active',
            ],
        ]);

        // ───────────────────────────────────
        // 2.  ROLE OWNERSHIP
        // ───────────────────────────────────
        // Dapatkan kembali ID user agar pasti akurat
        $vitovit            = DB::table('users')->where('username', 'vitovit')->value('id');
        $reva               = DB::table('users')->where('username', 'reva')->value('id');
        $adminParangan      = DB::table('users')->where('username', 'adminparangan')->value('id');
        $paranganGayamharjo = DB::table('users')->where('username', 'parangangayamharjo')->value('id');
        $timKknParangan     = DB::table('users')->where('username', 'timkknparangan')->value('id');

        DB::table('role_ownerships')->insert([
            // admin
            ['user_id' => $vitovit,            'role_id' => 2],
            ['user_id' => $reva,               'role_id' => 2],
            // super‑admin
            ['user_id' => $adminParangan,      'role_id' => 1],
            ['user_id' => $paranganGayamharjo, 'role_id' => 1],
            ['user_id' => $timKknParangan,     'role_id' => 1],
        ]);
    }
}
