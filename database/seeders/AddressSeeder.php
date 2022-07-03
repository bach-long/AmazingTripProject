<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
<<<<<<< HEAD
//use Illuminate\Support\Facades\DB;
use App\Models\Address;
=======
use Illuminate\Support\Facades\DB;

>>>>>>> da0a01569946ba48d57a93960ba496f3d95ee4c4
class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
        Address::factory()->times(5)->create();
        //factory(App\Models\Address::class, 10)->create();
=======
        DB::table('address')->insert([
            'id_host' => 1,
            'address_name' => 'HaTinh',
            'address_description' => 'Ha tinh dang trong qu atrinh phat trien ',
            'address_image' => 'https://bcp.cdnchinhphu.vn/Uploaded/tranducmanh/2021_06_22/HaTinh.jpg',
            'address_map' => 'address_map'
        ]);
>>>>>>> da0a01569946ba48d57a93960ba496f3d95ee4c4
    }
}
