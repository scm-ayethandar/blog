<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // 'title' => 'My title from factory',
            // 'body' => 'My post from factory',

            'title' => $this->faker->text(10),
            'body' => $this->faker->text(100),
            // 'user_id' => User::all(['id'])->random(),
            'user_id' => User::inRandomOrder()->first()->id,
            // 'image' => '/upload/images/wp2.jpg',
            // 'user_id' => User::inRandomOrder()->first()->id,
            // 'user_id' => User::where('id', rand(1, 5))->first()->id,
            // 'user_id' => User::factory()->create()->id,
        ];
    }
}
