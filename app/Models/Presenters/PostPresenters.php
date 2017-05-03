<?php

namespace App\Models\Presenters;

use App\Models\Category;
use App\T\Navigation\Navigation;
use Laracasts\Presenter\Presenter;

class PostPresenters extends Presenter
{
    protected static $currentCategory = null;

    public static function setCurrentCategory(Category $category)
    {
        static::$currentCategory = $category;
    }

    public function suitedTitle($length = 88)
    {
        return str_limit($this->title, $length);
    }

    public function getUrl()
    {
        if (is_null(static::$currentCategory)) {
            if(!$category = app(Navigation::class)->getCurrentNav()){
                $category = $this->categories->first();
            }
        }else{
            $category = static::$currentCategory;
        }

        return route('post', [$category->cate_slug, $this->id]);

    }
}