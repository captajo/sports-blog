<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->resource->load('category');

        return [
            'comments' => count($this->resource->comments) > 0 ? PostCommentResource::collection($this->resource->comments) : [],
            'author' => $this->resource->author->name,
            'title' => $this->resource->title,
            'id' => $this->resource->id,
            'slug' => $this->resource->slug,
            'body' => $this->resource->body,
            'image' => $this->resource->image,
            'status' => $this->resource->status,
            'updated_at' => Date('jS F, Y', strtotime($this->resource->updated_at)),
            'category' => $this->resource->category,
        ];
    }
}
