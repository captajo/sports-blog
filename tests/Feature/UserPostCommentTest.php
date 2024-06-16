<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserPostCommentTest extends TestCase
{
    use WithFaker;

    private $user;

    private $post;

    private $postCommentUrl = '/api/user/post/comments';

    private $postDatabase = 'post_comments';

    /**
     * A test that user can post comment
     */
    public function test_user_can_post_comment(): void
    {
        $this->setupUser();

        $post = $this->setupPost();

        $comment = $this->faker->paragraph();
        $response = $this->actingAs($this->user)->post($this->postCommentUrl, [
            'post_id' => $post->id,
            'body' => $comment,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas($this->postDatabase, [
            'post_id' => $post->id,
            'comment' => $comment,
            'user_id' => $this->user->id
        ]);
    }

    /**
     * A test that user can delete comment
     */
    public function test_user_can_delete_comment(): void
    {
        $this->setupUser();

        $post = $this->setupPost();

        $comment = $this->faker->paragraph();
        $response = $this->actingAs($this->user)->post($this->postCommentUrl, [
            'post_id' => $post->id,
            'body' => $comment,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas($this->postDatabase, [
            'post_id' => $post->id,
            'comment' => $comment,
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user)->delete($this->postCommentUrl . '/' . $response->json()['data']['id']);
        $response->assertStatus(200);

        $this->assertDatabaseMissing($this->postDatabase, [
            'post_id' => $post->id,
            'comment' => $comment,
            'user_id' => $this->user->id
        ]);
    }

    private function setupPost()
    {
        return Post::factory()->create(['user_id' => $this->user->id]);
    }

    private function setupUser()
    {
        if (!$this->user)
            $this->user = User::factory()->create();
    }
}
