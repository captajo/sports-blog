<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PostDetailResource;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserPostController extends Controller
{
    private $postService;

    private $userId;

    public function __construct()
    {
        $this->postService = new PostService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $this->userId = (auth()->user())->id;

        $posts = $this->postService->getUserPost($this->userId);

        return $this->sendOk(PostResource::collection($posts));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): JsonResponse
    {
        $categories = Category::all();

        return $this->sendOk([
            'categories' => CategoryResource::collection($categories)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePostRequest $request): JsonResponse
    {
        $this->userId = (auth()->user())->id;

        $post = $this->postService->addUserPost($request, $this->userId);

        return $this->sendOk(new PostResource($post));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug): JsonResponse
    {
        $post = $this->postService->getPostBySlug($slug);

        return $this->sendOk($post ? new PostDetailResource($post) : null);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): JsonResponse
    {
        $post = $this->postService->getPost($id);

        return $this->sendOk($post ? new PostDetailResource($post) : null);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, string $id): JsonResponse
    {
        $this->userId = (auth()->user())->id;
        
        $post = $this->postService->updateUserPost($request, $id, $this->userId);

        return $this->sendOk(new PostResource($post));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $this->userId = (auth()->user())->id;

        $this->postService->deleteUserPost((int) $id, $this->userId);

        return $this->sendOk("deleted successfully");
    }
}
