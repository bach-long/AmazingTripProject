<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class BlogAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model= \App\Models\BlogAddress::class;
    public function definition()
    {
        return [
            'id_user'=>$this->faker->numberBetween(1,10),
            'address_id'=>$this->faker->numberBetween(1,20),
            'blog_address_vote'=>$this->faker->numberBetween(1,5),
            'blog_address_image'=>('https://tse2.mm.bing.net/th?id=OIP.ySHXO2aEhf09o8Sj_W_ktQHaE2&pid=Api&P=0&w=246&h=161'),
            'blog_address_content'=>$this->faker->text($maxNbChars=200)
        ];
    }
}
