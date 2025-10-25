<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;


class CommentFactory extends Factory
{
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $text = $this->faker->sentences(2, true);

        return [

            'user_id' => User::factory(),
            'post_id' => Post::factory(),
            'comment' => $text,
            'content' => $text,
            'author_name' => null,
        ];
    }

    public function guest(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'user_id' => null,
                'author_name' => $this->faker->name(),
            ];
        });
    }
}