<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
<<<<<<< HEAD
//use Illuminate\Support\Facades\DB;
use App\Models\User;
use Faker\Factory as Faker;
=======
use Illuminate\Support\Facades\DB;
>>>>>>> da0a01569946ba48d57a93960ba496f3d95ee4c4

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
<<<<<<< HEAD
    {    
        User::factory()->count(20)->create();
=======
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
>>>>>>> da0a01569946ba48d57a93960ba496f3d95ee4c4
    }
}
