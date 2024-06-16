<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ModeratePostRequest;
use App\Http\Resources\PostResource;
use App\Services\PostService;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    private $postService;

    private $userId;

    public function __construct()
    {
        $this->postService = new PostService();
        $this->userId = (auth()->user())->id;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = $this->postService->getPosts();
        return $this->sendOk(PostResource::collection($posts));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = $this->postService->getPost($id);

        return $this->sendOk($post ? new PostResource($post) : null);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ModeratePostRequest $request, string $id)
    {
        $post = $this->postService->moderatePost($id, $request);

        return $this->sendOk(new PostResource($post));
    }
}
