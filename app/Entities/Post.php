<?php

namespace App\Entities;


use App\Entities\Traits\Picture;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends BaseModel
{
    use SoftDeletes, Picture;

    protected $dates = ['deleted_at', 'top'];

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'author');
    }

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }

    public function scopePost($query)
    {
        return $query->where('type', 'post');
    }

    public function scopePage($query)
    {
        return $query->where('type', 'page');
    }

    public function scopeDraft($query)
    {
        return $query->where('type', 'draft');
    }

    public function scopePublish($query)
    {
        return $query->where('status', 'publish');
    }

    public function scopeOrderByTop($query)
    {
        return $query->orderBy('top', 'DESC');
    }

}
