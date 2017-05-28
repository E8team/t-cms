<?php

namespace App\Events;

use App\Models\Category;

class VisitPostList
{

    public $category;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }
}
