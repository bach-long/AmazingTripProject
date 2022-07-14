<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
class CommentBlogAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model= \App\Models\CommentBlogAddress::class;
    public function definition()
    {
        return [
            'blog_address_id'=>$this->faker->numberBetween(1,10),
            'id_user'=>$this->faker->numberBetween(1,10),
            'comment_address_image'=>null,
            'comment_address_content'=>$this->faker->text($maxNbChars = 200)
        ];
    }
}
