<?php


namespace App\T\Navigation;


use App\Entities\Category;

class Navigation
{
    public function getNav()
    {
        return Category::nav()->topCategories()->with('children')
            ->ordered()->recent()->get();


    }

    public function getNavFromCache()
    {
        return $this->getNav();
    }
}