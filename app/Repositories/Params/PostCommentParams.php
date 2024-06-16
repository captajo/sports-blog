<?php

namespace App\Repositories\Params;

class PostCommentParams {

    /** Author Id */
    public int $postId;
    
    /** Body */
    public string $body;

    /** Author Id */
    public int $userId;

    public function setPostId(int $postId)
    {
        $this->postId = $postId;
    }

    public function setBody(string $body)
    {
        $this->body = $body;
    }

    public function setAuthor(int $userId)
    {
        $this->userId = $userId;
    }
}