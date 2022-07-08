<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
class BookmarkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model= \App\Models\Bookmark::class;
    public function definition()
    {
        return [
            'id_user'=>$this->faker->numberBetween(1,20),
            'address_id'=>$this->faker->numberBetween(1,20)
        ];
    }
}
