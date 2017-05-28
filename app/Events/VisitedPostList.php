<?php

namespace App\Events;

use App\Models\Category;

class VisitedPostList
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
