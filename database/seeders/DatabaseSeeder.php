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
            'username' => 'admin',
            'phone_num' => '0123456789',
            'email' => 'admin@argon.com',
            'role' => 'admin',
            'password' => bcrypt('1234')
        ]);
        DB::table('users')->insert([
            'username' => 'parent',
            'phone_num' => '0123456781',
            'email' => 'parent@argon.com',
            'role' => 'parent',
            'password' => bcrypt('1234')
        ]);
        DB::table('users')->insert([
            'username' => 'staff',
            'phone_num' => '0122233112',
            'email' => 'staff@argon.com',
            'role' => 'staff',
            'password' => bcrypt('1234')
        ]);
    }
}
