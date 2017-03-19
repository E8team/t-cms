<?php

namespace App\Entities;


class Type extends BaseModel
{
    public $timestamps = false;

    /**
     * Get all of the owning commentable models.
     */
    public function typeable()
    {
        return $this->morphTo();
    }
}
