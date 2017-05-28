<?php

namespace App\Widgets;


use App\Models\Category;
use Exception;

class PostList extends BaseWidget
{
    public $category;
    public $limit = 10;

    public function setCategroy(Category $category)
    {
        if($category->isPostList())
            $this->category = $category;
        else
            throw new Exception('the category is not postList');
    }

    public function getViewName()
    {
        return $this->viewName ?: 'widgets.postList.'.$this->category->cate_slug;
    }

    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

    public function getData()
    {
        return $this->category->postListWithOrder('default')->limit($this->limit)->get();
    }
}