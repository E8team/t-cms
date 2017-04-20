<?php

namespace App\Entities\Presenters;

use App\Entities\Category;
use Laracasts\Presenter\Presenter;

class PostPresenters extends Presenter
{
    protected static $currentCategory = null;

    public static function setCurrentCategory(Category $category)
    {
        static::$currentCategory = $category;
    }

    public function suitedTitle()
    {
        return str_limit($this->title, 88);
    }

    public function getUrl()
    {
        if (is_null(static::$currentCategory)) {
            return route('post', [$this->categories->first()->cate_slug, $this->id]);
        } else {
            return route('post', [static::$currentCategory->cate_slug, $this->id]);
        }
    }
}