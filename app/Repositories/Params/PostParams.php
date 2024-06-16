<?php

namespace App\Repositories\Params;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostParams {

    /** Title */
    public string $title;

    /** Slug */
    public string $slug;
    
    /** Body */
    public string $body;

    /** Image */
    public ?string $image;

    /** Author Id */
    public int $userId;

    /** Category */
    public ?int $categoryId;

    public function setTitle(string $title)
    {
        $this->title = $title;
        $this->slug = Str::slug($title, "-");
    }

    public function setBody(string $body)
    {
        $this->body = $body;
    }

    public function setAuthor(int $userId)
    {
        $this->userId = $userId;
    }

    public function setImage(?string $image)
    {
        if (!$image) {
            $this->image = null;
            return;
        }

        $partImage = explode(';base64,', $image);
        $image_type_aux = explode("image/", $partImage[0]);
        $image_type = $image_type_aux[1];
        $fileName = 'post-' . time() . '.' . $image_type;

        $imageBase64 = base64_decode($partImage[1]);
        Storage::disk('public')->put($fileName, $imageBase64);
        $storagePath = Storage::disk('public')->url($fileName);

        $this->image = $storagePath;
    }

    public function setCategoryId(?int $categoryId)
    {
        $this->categoryId = $categoryId;
    }
    
}