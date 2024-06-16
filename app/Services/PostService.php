<?php

namespace App\Services;

use App\Exceptions\BadRequestException;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\ModeratePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use App\Repositories\Params\PostParams;
use App\Repositories\PostRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class PostService
{
    private $postRepository;

    public function __construct()
    {
        // initialize Post Repository
        $this->postRepository = new PostRepository();
    }
    
    /**
     * Get Posts
     *
     * @return LengthAwarePaginator
     */
    public function getPosts(): ?LengthAwarePaginator
    {
        return $this->postRepository->getAllPost();
    }
    
    /**
     * Get User Post
     *
     * @param  int $userId
     * @return LengthAwarePaginator
     */
    public function getUserPost(int $userId): ?LengthAwarePaginator
    {
        return $this->postRepository->getUserPosts($userId);
    }
    
    /**
     * Get Post
     *
     * @param  int $postId
     * @return Post
     */
    public function getPost(int $postId): ?Post
    {
        return $this->postRepository->getPost($postId);
    }

    /**
     * Get Post By Slug
     *
     * @param  string $slug
     * @return Post
     */
    public function getPostBySlug(string $slug): ?Post
    {
        return $this->postRepository->getPostBySlug($slug);
    }

    /**
     * Get Random Posts
     *
     * @return Collection
     */
    public function getRandomPosts(): ?Collection
    {
        return $this->postRepository->getRandomPosts();
    }

    /**
     * Get Latest Posts
     *
     * @return Collection
     */
    public function getLatestPosts(): ?Collection
    {
        return $this->postRepository->getLatestPosts();
    }

    /**
     * Get Category Posts
     *
     * @return LengthAwarePaginator
     */
    public function getCategoryPosts(int $id): ?LengthAwarePaginator
    {
        return $this->postRepository->getCategoryPosts($id);
    }

    /**
     * Get Random Posts
     *
     * @return array
     */
    public function getRandomCategoryPosts(): ?array
    {
        $categories = Category::inRandomOrder()->take(3)->get();

        $output = [];
        foreach ($categories as $category) {
            $posts = $this->postRepository->getRandomCategoryPosts($category->id);
            $output[] = [
                'category' => new CategoryResource($category),
                'posts' => PostResource::collection($posts)
            ];
        }

        return $output;
    }

    /**
     * Search Posts
     *
     * @param  string $search
     * @return Collection
     */
    public function searchPosts(string $search): ?Collection
    {
        return $this->postRepository->getSearchPosts($search);
    }
    
    /**
     * Add User Post
     *
     * @param  CreatePostRequest $request
     * @param  int $userId
     * @return Post
     */
    public function addUserPost(CreatePostRequest $request, int $userId): Post
    {
        $params = new PostParams();
        $params->setTitle($request->get('title'));
        $params->setBody($request->get('body'));
        $params->setImage($request->get('image'));
        $params->setCategoryId($request->get('category_id'));
        $params->setAuthor($userId);
        
        $post = $this->postRepository->savePost($params);

        if (!$post) throw new BadRequestException("Could not create the post. Please try again");

        return $post;
    }
    
    /**
     * Update User Post
     *
     * @param  UpdatePostRequest $request
     * @param  int $userId
     * @return Post
     */
    public function updateUserPost(UpdatePostRequest $request, int $postId, int $userId): Post
    {
        $params = new PostParams();
        $params->setTitle($request->get('title'));
        $params->setBody($request->get('body'));
        $params->setImage($request->get('image'));
        $params->setCategoryId($request->get('category_id'));
        $params->setAuthor($userId);

        $post = $this->postRepository->getPost($postId);
        if ($post->title != $params->title) {
            $checkIfExist = $this->postRepository->getPostByTitle($params->title);
            if ($checkIfExist) throw new BadRequestException("A title already exist with this name.");
        }
        
        $post = $this->postRepository->editPost($postId, $params);

        if (!$post) throw new BadRequestException("Could not update the post. Please try again");

        return $post;
    }
    
    /**
     * Delete User Post
     *
     * @param  int $postId
     * @param  int $userId
     * @return void
     */
    public function deleteUserPost(int $postId, int $userId): void
    {
        $isDeleted = $this->postRepository->deletePost($postId, $userId);

        if (!$isDeleted) throw new BadRequestException("Could not delete the post. Please try again");
    }
    
    /**
     * Moderate Post
     *
     * @param  int $postId
     * @param  string $status
     * @return Post
     */
    public function moderatePost(int $postId, ModeratePostRequest $request): Post
    {
        return $this->postRepository->moderatePost($postId, $request->get('status'));
    }
}