<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
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
            'password' => Hash::make('ChangeThisLater'),
            'user_role' => 1,
            'user_status' => 1,
        ]);
    }
}
