<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\VotePostCommentRequest;
use App\Http\Resources\PostCommentVoteResource;
use App\Services\PostCommentService;
use Illuminate\Http\Request;

class UserPostCommentVoteController extends Controller
{
    private $postCommentService;

    private $userId;

    public function __construct()
    {
        $this->postCommentService = new PostCommentService();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VotePostCommentRequest $request)
    {
        $this->userId = (auth()->user())->id;

        $post = $this->postCommentService->votePostComment($request, $this->userId);

        return $this->sendOk(new PostCommentVoteResource($post));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->userId = (auth()->user())->id;

        $this->postCommentService->deletePostCommentVote($id, $this->userId);

        return $this->sendOk("Vote has been removed");
    }
}
