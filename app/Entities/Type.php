<?php

namespace App\Entities;


class Type extends BaseModel
{
    public $timestamps = false;

    public function scopeLinkType($query)
    {
        return $query->where('typeable_type', Link::class);
    }

    public function link()
    {
        return $this->hasMany(Link::class);
    }
}
