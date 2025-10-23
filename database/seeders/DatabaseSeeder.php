<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {

        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'), 
                'email_verified_at' => now(),
            ]
        );

        User::factory(5)->create()->each(function ($user) {
            Post::factory(4)->create(['user_id' => $user->id])->each(function ($post) use ($user) {
                Comment::factory(3)->create([
                    'post_id' => $post->id,
                    'user_id' => $user->id,
                ]);
            });
        });
    }
}
