<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'k_admin',
            'phone_num' => '0123456789',
            'ic' => '111122223333',
            'email' => 'admin@argon.com',
            'role' => 'k_admin',
            'password' => bcrypt('1234')
        ]);
        DB::table('users')->insert([
            'username' => 'staff',
            'phone_num' => '0122233112',
            'ic' => '222233334444',
            'email' => 'staff@argon.com',
            'role' => 'staff',
            'password' => bcrypt('1234')
        ]);
        DB::table('users')->insert([
            'username' => 'parent',
            'phone_num' => '0123456781',
            'email' => 'parent@argon.com',
            'ic' => '444455556666',
            'role' => 'parent',
            'password' => bcrypt('1234')
        ]);
        DB::table('users')->insert([
            'username' => 'MUIP',
            'phone_num' => '0124563779',
            'ic' => '777788889999',
            'email' => 'muip@argon.com',
            'role' => 'MUIP',
            'password' => bcrypt('1234')
        ]);
    }
}
