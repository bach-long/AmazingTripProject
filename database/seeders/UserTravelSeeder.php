<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\UserTravel;
use Faker\Factory as Faker;

class UserTravelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {    
        $faker = Faker::create();
        foreach(range(1,10) as $user_travel){
            DB::table('user_travel')->insert([
                'username'=>$faker->name ,
                'birthday'=>$faker->date($format = 'Y-m-d', $max = 'now'),
                'email'=>$faker->email,
                'phone'=>$faker->phoneNumber,
                'password'=>bcrypt('secret'),
                'address'=>$faker->address,
                'nickname'=>$faker->lastName  ,
                'avatar'=>('https://wikihoidap.org/assets/default/images/avatar_2x.png'),
                'role'  =>$faker->randomElement([1, 2, 3])
            ]);
        }

    }
}
