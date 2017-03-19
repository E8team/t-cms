<?php

namespace App\Entities;


class Link extends BaseModel
{
    public $timestamps = false;
    public function type()
    {
        return $this->morphOne(Type::class, 'typeable');
    }
}
