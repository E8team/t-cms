<?php

namespace App\Entities;

class PostContents extends BaseModel
{
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
