<?php

namespace App\Entities;

class Category extends BaseModel
{
    public $timestamps = false;

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    /**
     * 单页
     */
    public function page()
    {
        return $this->hasOne(Page::class);
    }
}
