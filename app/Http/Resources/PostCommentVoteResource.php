<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostCommentVoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'comment' => $this->resource->comment,
            'author' => $this->resource->user->name,
            'updated_at' => Date('jS F, Y', strtotime($this->resource->created_at)),
        ];
    }
}
