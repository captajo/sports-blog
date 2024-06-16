<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Services\PostService;
use Illuminate\Http\Request;

class HomeController extends Controller
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
    public function index()
    {
        $posts = $this->postService->getRandomPosts();

        return $this->sendOK(count($posts) > 0 ? PostResource::collection($posts) : []);
    }

    /**
     * Display a category listing of the resource.
     */
    public function showRandomCategories()
    {
        $posts = $this->postService->getRandomCategoryPosts();

        return $this->sendOK($posts);
    }

    /**
     * Display a latest listing of the resource.
     */
    public function latestPosts()
    {
        $posts = $this->postService->getLatestPosts();

        return $this->sendOK(count($posts) > 0 ? PostResource::collection($posts) : []);
    }

    /**
     * Display a latest listing of the resource.
     */
    public function showCategoryPosts($id)
    {
        $posts = $this->postService->getCategoryPosts($id);

        return $this->sendOK(PostResource::collection($posts));
    }

    /**
     * Display a latest listing of the resource.
     */
    public function searchPosts(Request $request)
    {
        $posts = $this->postService->searchPosts($request->get('search'));

        return $this->sendOK(PostResource::collection($posts));
    }
}
