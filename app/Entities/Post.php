<?php

namespace App\Entities;


use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends BaseModel
{
    use SoftDeletes;

    protected $dates = ['deleted_at', 'top'];

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'post_author');
    }

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }

    public function scopePage($query)
    {
        return $query->where('post_type', 'post');
    }

    public function scopeDraft($query)
    {
        return $query->where('post_type', 'draft');
    }

    public function scopePublish($query)
    {
        return $query->where('post_status', 'publish');
    }

    public function scopeOrderByTop($query)
    {
        return $query->orderBy('top', 'DESC');
    }

    //附件
    public function scopeAttachment($query)
    {
        return $query->where('post_type', 'attachment');
    }
}
