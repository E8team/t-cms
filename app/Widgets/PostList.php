<?php

namespace App\Widgets;


use App\Models\Category;
use App\Repositories\CategoryRepository;
use Exception;

class PostList extends BaseWidget
{
    public $category;
    public $limit = 10;

    public function setCategory($category)
    {
        if(is_string($category)){
            $category = app(CategoryRepository::class)->findBySlug($category);
        }elseif(is_numeric($category)){
            $category = Category::find($category);
        }
        if($category->isPostList())
            $this->category = $category;
        else
            throw new Exception('the category is not postList');
        return $this;
    }

    public function getViewName()
    {
        return $this->viewName ?: 'widgets.postList.'.$this->category->cate_slug;
    }

    public function setLimit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    public function getData()
    {
        return [
            'posts' => $this->category->postListWithOrder('default')->limit($this->limit)->get()
        ];
    }
}