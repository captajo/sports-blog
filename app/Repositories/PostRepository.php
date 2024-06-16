<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Params\PostParams;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostRepository
{
    private Post $post;

    public function __construct()
    {
        // initialize model
        $this->post = new Post();
    }
    
    /**
     * Get All Post
     *
     * @return LengthAwarePaginator
     */
    public function getAllPost(): ?LengthAwarePaginator
    {
        return $this->post->orderBy('id', 'DESC')->with('author')->withCount('comments')->paginate(50);
    }
    
    /**
     * Get User's Posts
     *
     * @param  int $userId
     * @return LengthAwarePaginator
     */
    public function getUserPosts(int $userId): ?LengthAwarePaginator
    {
        return $this->post->where('user_id', $userId)->orderBy('id', 'DESC')->paginate(50);
    }

    /**
     * Get Category Post
     *
     * @param  int $categoryId
     * @return LengthAwarePaginator|null
     */
    public function getCategoryPosts(int $categoryId): ?LengthAwarePaginator
    {
        return $this->post->where('category_id', $categoryId)->with('author', 'comments')->orderBy('id', 'DESC')->paginate(20);
    }
    
    /**
     * Get Post
     *
     * @param  int $postId
     * @return Post|null
     */
    public function getPost(int $postId): ?Post
    {
        return $this->post->where('id', $postId)->with('author', 'comments')->first();
    }

    /**
     * Get Post By Title
     *
     * @param  string $title
     * @return Post|null
     */
    public function getPostByTitle(string $title): ?Post
    {
        return $this->post->where('title', $title)->with('author', 'comments')->first();
    }

    /**
     * Get Random Post
     *
     * @return Collection|null
     */
    public function getRandomPosts(): ?Collection
    {
        return $this->post->with('author', 'comments')->inRandomOrder()->take(4)->get();
    }

    /**
     * Get Random Post
     *
     * @param  int $categoryId
     * @return Collection|null
     */
    public function getRandomCategoryPosts(int $categoryId): ?Collection
    {
        return $this->post->where('category_id', $categoryId)->with('author', 'comments')->inRandomOrder()->take(5)->get();
    }

    /**
     * Latest Posts
     *
     * @return Collection|null
     */
    public function getLatestPosts(): ?Collection
    {
        return $this->post->with('author', 'comments')->orderBy('id', 'DESC')->take(6)->get();
    }

    /**
     * Search Posts
     *
     * @return Collection|null
     */
    public function getSearchPosts(string $search): ?Collection
    {
        $search = '%' . $search . '%';
        return $this->post->where('title', 'like', $search)->orWhere('body', 'like', $search)
                            ->with('author', 'comments')->orderBy('id', 'DESC')->take(20)->get();
    }

    /**
     * Get Post By Slug
     *
     * @param  int $slug
     * @return Post|null
     */
    public function getPostBySlug(string $slug): ?Post
    {
        return $this->post->where('slug', $slug)->with('author', 'comments')->first();
    }
    
    /**
     * Save Post in database
     *
     * @param  PostParams $params
     * @return Post
     */
    public function savePost(PostParams $params): ?Post
    {
        try {
            // create new Post
            $post = new $this->post;
            $post->title = $params->title; 
            $post->body = $params->body; 
            $post->image = $params->image; 
            $post->slug = $params->slug; 
            $post->user_id = $params->userId; 
            $post->category_id = $params->categoryId;
            $post->status = config('app.default_post_status'); 
            $post->save(); 

        } catch (\Exception $ex) {

            Log::info($ex);
            return null;

        }

        return $post;
    }

        
    /**
     * Edit User Post
     *
     * @param  int $postId
     * @param  PostParams $params
     * @return Post
     */
    public function editPost(int $postId, PostParams $params): ?Post
    {
        try {
            // create new Post
            $post = $this->post->where('id', $postId)->where('user_id', $params->userId)->first();

            if ($params->title != $post->title) {
                $post->title = $params->title; 
            }

            $post->body = $params->body; 
            $post->category_id = $params->categoryId;
            
            if ($params->image) $post->image = $params->image; 

            $post->save(); 

        } catch (\Exception $ex) {

            Log::info($ex);
            return null;

        }

        return $post;
    }
        
    /**
     * Delete Post
     *
     * @param  int $postId
     * @param  int $userId
     * @return bool
     */
    public function deletePost(int $postId, int $userId): bool
    {
        DB::beginTransaction();
        try {
            // create new Post
            $post = $this->post->where('id', $postId)->where('user_id', $userId)->first();
            
            $post->comments()->delete();
            $post->votes()->delete();
            $post->delete();

        } catch (\Exception $ex) {
            DB::rollBack();
            Log::info($ex);
            return false;

        }
        DB::commit();

        return true;
    }
    
    /**
     * Moderate Post
     *
     * @param  int $postId
     * @param  string $status
     * @return Post
     */
    public function moderatePost(int $postId, string $status): ?Post
    {
        // create new Post
        try {

            $post = $this->post->where('id', $postId)->first();
            $post->status = $status;
            $post->save();

        } catch (\Exception $ex) {
            Log::info($ex);
            return null;
        }

        return $post;
    }
}
