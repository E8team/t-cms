<?php

namespace App\Entities;


use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends BaseModel
{
    use SoftDeletes;

    protected $dates = ['deleted_at', 'top'];

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'author');
    }

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }

    public function scopePage($query)
    {
        return $query->where('type', 'post');
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

    //附件
    public function scopeAttachment($query)
    {
        return $query->where('type', 'attachment');
    }
}
