<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Thinkian',
            'email' => 'thikian@thik.com',
            'password' => Hash::make('password'),
            'user_role' => '1',
            'user_status' => '1'
        ]);
    }
}
