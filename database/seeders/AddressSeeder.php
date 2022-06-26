<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('address')->insert([
            'id_host' => 1,
            'address_name' => 'HaTinh',
            'address_description' => 'Ha tinh dang trong qu atrinh phat trien ',
            'address_image' => 'https://bcp.cdnchinhphu.vn/Uploaded/tranducmanh/2021_06_22/HaTinh.jpg',
            'address_map' => 'address_map'
        ]);
    }
}
