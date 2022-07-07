<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_travel')->insert([
            'username' => 'Nguyen trang',
            'email' => 'Trang0208@gmail.com',
            'phone' => '090909090',
            'address' => 'Da nang',
            'nickname' => 'ut',
            'birthday' => '2002-08-02',
            'avatar' => 'null',
            'role' => 2,
            'password' => bcrypt('vinhvinh')
        ]);
    }
}
