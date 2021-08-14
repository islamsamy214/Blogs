<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'title'=>$this->faker->title, 
            'body'=>$this->faker->text, 
            'user_id'=>rand(1,10),
            'category_id'=>rand(1,10),
        ];
    }
}
