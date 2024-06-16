<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostCommentRequest;
use App\Http\Resources\PostCommentResource;
use App\Services\PostCommentService;
use Illuminate\Http\Request;

class UserPostCommentController extends Controller
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
    public function store(CreatePostCommentRequest $request)
    {
        $this->userId = (auth()->user())->id;

        $post = $this->postCommentService->savePostComment($request, $this->userId);

        return $this->sendOk(new PostCommentResource($post));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->userId = (auth()->user())->id;

        $this->postCommentService->deletePostComment($id, $this->userId);

        return $this->sendOk("Comment deleted successfully");
    }
}
