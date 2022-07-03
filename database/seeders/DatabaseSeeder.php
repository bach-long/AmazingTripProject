<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
<<<<<<< HEAD
use Illuminate\Support\Facades\DB;
use App\Models\Travel;
use App\Models\Address;
use App\Models\BlogAddress;
use App\Models\Group;
=======

>>>>>>> da0a01569946ba48d57a93960ba496f3d95ee4c4
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
<<<<<<< HEAD
        $this->call(UserSeeder::class);
        $this->call(AddressSeeder::class);
        $this->call(BlogAddressSeeder::class);
        $this->call(GroupSeeder::class);
=======
>>>>>>> da0a01569946ba48d57a93960ba496f3d95ee4c4
    }
}
