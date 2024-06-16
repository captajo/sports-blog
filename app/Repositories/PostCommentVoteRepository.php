<?php

namespace App\Repositories;

use App\Models\PostComment;
use App\Models\PostCommentVote;
use App\Repositories\Params\PostCommentParams;
use Illuminate\Support\Facades\Log;

class PostCommentVoteRepository
{
    private PostCommentVote $postCommentVote;

    public function __construct()
    {
        // initialize model
        $this->postCommentVote = new PostCommentVote();
    }
    
    /**
     * Add Comment Vote
     *
     * @param  int $postCommentId
     * @param  int $userId
     * @param  bool $isLiked
     * @return PostCommentVote
     */
    public function addCommentVote(int $postCommentId, int $userId, bool $isLiked): ?PostCommentVote
    {
        try {
            $postCommentVote = $this->postCommentVote->where('post_comment_id', $postCommentId)
                                                            ->where('user_id', $userId)->first();

            if (!$postCommentVote) {
                $postCommentVote = new $this->postCommentVote;
                $postCommentVote->post_comment_id = $postCommentId;
                $postCommentVote->user_id = $userId;
            }
            $postCommentVote->is_like = $isLiked;
            $postCommentVote->save();            
        } catch (\Exception $ex) {
            Log::error($ex);
            return null;
        }

        return $postCommentVote;
    }
    
    /**
     * Delete Comment Vote
     *
     * @param  mixed $postCommentId
     * @param  mixed $userId
     * @return bool
     */
    public function deleteCommentVote(int $postCommentId, int $userId): bool
    {
        try {
            $postCommentVote = $this->postCommentVote->where('post_comment_id', $postCommentId)
                                                            ->where('user_id', $userId)->first();

            if ($postCommentVote) {
                $postCommentVote->delete();
            }           
        } catch (\Exception $ex) {
            Log::error($ex);
            return false;
        }

        return true;
    }
}