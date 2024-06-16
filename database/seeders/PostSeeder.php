<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            $sampleUserEmail = 'sample-user-'.$category->id.'@test.com';

            // create dummy user one
            if (!$user = User::where('email', $sampleUserEmail)->first())
                $user = User::factory()->create(['email' => $sampleUserEmail]);

            // create multiple post
            Post::factory()->count(rand(10, 15))
            ->state(new Sequence(
                fn (Sequence $sequence) => ['user_id' => $user->id, 'category_id' => $category->id],
            ))->has(
                PostComment::factory()->count(rand(3,6))->state(function (array $attributes, Post $post) {
                    return ['post_id' => $post->id, 'user_id' => $post->user_id];
                }), 'comments'
            )->create();
        }
        
    }
}
