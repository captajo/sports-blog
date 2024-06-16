<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * @var Post
     */
    public $resource;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->resource->load('category');

        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'slug' => $this->resource->slug,
            'body' => $this->resource->body,
            'image' => $this->resource->image,
            'status' => $this->resource->status,
            'author' => $this->resource->author->name,
            'updated_at' => Date('jS F, Y', strtotime($this->resource->updated_at)),
            'category' => $this->resource->category ? $this->resource->category->name : '',
        ];
    }
}
