<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserPostTest extends TestCase
{
    use WithFaker;

    private $user;

    private $post;

    private $postUrl = '/api/user/posts';

    private $postDatabase = 'posts';

    /**
     * Test user can create posts
     */
    public function test_user_can_create_posts(): void
    {
        $this->setupUser();

        $newTitle = $this->faker->sentence();
        $newBody = $this->faker->paragraph();

        $response = $this->actingAs($this->user)->post($this->postUrl, [
            'title' => $newTitle,
            'body' => $newBody,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas($this->postDatabase, [
            'title' => $newTitle,
            'user_id' => $this->user->id
        ]);
    }

    /**
     * Test user can not create post with same title
     */
    public function test_user_can_not_create_post_with_same_title(): void
    {
        $this->setupUser();

        $newTitle = $this->faker->sentence();
        $newBody = $this->faker->paragraph();

        $response = $this->actingAs($this->user)->post($this->postUrl, [
            'title' => $newTitle,
            'body' => $newBody
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas($this->postDatabase, [
            'title' => $newTitle,
            'user_id' => $this->user->id
        ]);

        $response2 = $this->actingAs($this->user)->post($this->postUrl, [
            'title' => $newTitle,
            'body' => $newBody
        ]);

        $response2->assertStatus(302); // test it was rejected
    }

    /**
     * Test user can create posts
     */
    public function test_user_can_update_posts(): void
    {
        $this->setupUser();

        $post = $this->setupPost();

        $body = $this->faker->paragraph();
        $response = $this->actingAs($this->user)->put($this->postUrl . '/' . $post->id, [
            'title' => $post->title,
            'body' => $body
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas($this->postDatabase, [
            'title' => $post->title,
            'body' => $body,
            'user_id' => $this->user->id
        ]);
    }

    /**
     * Test user can get his/her posts
     */
    public function test_user_can_get_posts(): void
    {
        $this->setupUser();

        $response = $this->actingAs($this->user)->get($this->postUrl);

        $response->assertStatus(200);

        $this->assertEquals("success", $response->json()['status']);
        $this->assertGreaterThan(0, $response->json()['data']);
    }

    /**
     * Test user can delete posts
     */
    public function test_user_can_delete_posts(): void
    {
        $this->setupUser();

        $post = $this->setupPost();

        $response = $this->actingAs($this->user)->delete($this->postUrl . '/' . $post->id);

        $response->assertStatus(200);
        $this->assertDatabaseMissing($this->postDatabase, [
            'title' => $post->title,
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
