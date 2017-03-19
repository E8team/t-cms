<?php

namespace App\Entities;


use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends BaseModel
{
    use SoftDeletes;

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'post_author');
    }

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }

}
