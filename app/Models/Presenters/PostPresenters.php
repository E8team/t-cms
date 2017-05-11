<?php

namespace App\Models\Presenters;

use App\Models\Category;
use App\T\Navigation\Navigation;
use Laracasts\Presenter\Presenter;

class PostPresenters extends Presenter
{
    protected static $activeCategory = null;

    public static function setActiveCategory(Category $category)
    {
        static::$activeCategory = $category;
    }

    public function suitedTitle($length = 88)
    {
        return str_limit($this->title, $length);
    }

    public function getUrl()
    {
        if (is_null(static::$activeCategory)) {
            if (!$category = app(Navigation::class)->getActiveNav()) {
                $category = $this->categories->first();
            }
        } else {
            $category = static::$activeCategory;
        }

        return route('post', [$category->cate_slug, $this->id]);
    }
}
