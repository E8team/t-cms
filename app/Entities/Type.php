<?php

namespace App\Entities;


class Type extends BaseModel
{
    protected $fillable = ['name', 'description', 'order', 'class_name'];

    public $timestamps = false;

    public function scopeLink($query)
    {
        return $query->where('class_name', Link::class)->ordered();
    }

    public function links()
    {
        return $this->hasMany(Link::class);
    }
}
