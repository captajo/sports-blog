<?php

namespace App\Repositories;

use App\Models\PostComment;
use App\Repositories\Params\PostCommentParams;
use Illuminate\Support\Facades\Log;

class PostCommentRepository
{
    private PostComment $postComment;

    public function __construct()
    {
        // initialize model
        $this->postComment = new PostComment();
    }
    
    /**
     * Save Post Comment
     *
     * @param  PostCommentParams $params
     * @return PostComment
     */
    public function savePostComment(PostCommentParams $params): ?PostComment
    {
        try {
            $postComment = new $this->postComment;
            $postComment->post_id = $params->postId;
            $postComment->comment = $params->body;
            $postComment->user_id = $params->userId;
            $postComment->status = config('app.default_comment_status');
            $postComment->save();
        } catch (\Exception $ex) {
            Log::error($ex);
            return null;
        }
        return $postComment;
    }
    
    /**
     * Delete Post Comment
     *
     * @param  int $postCommentId
     * @param  int $userId
     * @return bool
     */
    public function deletePostComment(int $postCommentId, int $userId): bool
    {
        try {
            $postComment = $this->postComment->where('id', $postCommentId)->where('user_id', $userId)->first();
            $postComment->delete();
        } catch (\Exception $ex) {
            Log::error($ex);
            return false;
        }

        return true;
    }
}