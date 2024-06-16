<?php

namespace App\Services;

use App\Exceptions\BadRequestException;
use App\Http\Requests\CreatePostCommentRequest;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\ModeratePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\VotePostCommentRequest;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\PostCommentVote;
use App\Repositories\Params\PostCommentParams;
use App\Repositories\Params\PostParams;
use App\Repositories\PostCommentRepository;
use App\Repositories\PostCommentVoteRepository;
use App\Repositories\PostRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PostCommentService
{
    private $postCommentRepository;

    private $postCommentVoteRepository;

    public function __construct()
    {
        // initialize Post Comment / Vote Repository
        $this->postCommentRepository = new PostCommentRepository();
        $this->postCommentVoteRepository = new PostCommentVoteRepository();
    }
    
    /**
     * Save Post Comment
     *
     * @param  CreatePostCommentRequest $request
     * @param  int $userId
     * @return PostComment
     */
    public function savePostComment(CreatePostCommentRequest $request, int $userId): PostComment
    {
        $params = new PostCommentParams();
        $params->setAuthor($userId);
        $params->setBody($request->get('body'));
        $params->setPostId($request->get('post_id'));

        $postComment = $this->postCommentRepository->savePostComment($params);

        if (!$postComment) throw new BadRequestException("Could not create your comment. Please try again.");

        return $postComment;
    }
    
    /**
     * Delete Post Comment
     *
     * @param  int $postCommentId
     * @param  int $userId
     * @return void
     */
    public function deletePostComment(int $postCommentId, int $userId): void
    {
        $isDeleted = $this->postCommentRepository->deletePostComment($postCommentId, $userId);

        if (!$isDeleted) throw new BadRequestException("Could not delete your comment. Please try again.");
    }
    
    /**
     * Vote Post Comment
     *
     * @param  VotePostCommentRequest $request
     * @param  int $userId
     * @return PostCommentVote
     */
    public function votePostComment(VotePostCommentRequest $request, int $userId): PostCommentVote
    {
        $postCommentVote = $this->postCommentVoteRepository->addCommentVote(
                                                                $request->get('post_id'),
                                                                $userId,
                                                                $request->get('is_liked')
                                                            );
                                        
        if (!$postCommentVote) throw new BadRequestException("Could not vote the comment. Please try again.");

        return $postCommentVote;
    }

    /**
     * Delet Post Comment Vote
     *
     * @param  int $request
     * @param  int $userId
     * @return void
     */
    public function deletePostCommentVote(int $postCommentId, int $userId): void
    {
        $postCommentVote = $this->postCommentVoteRepository->deleteCommentVote($postCommentId,$userId);
                                        
        if (!$postCommentVote) throw new BadRequestException("Could not delete vote on this comment. Please try again.");
    }
}