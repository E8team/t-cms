<?php


namespace App\T\Navigation;


use App\Entities\Category;

class Navigation
{
    protected $allNav = null;
    /**
     * @var Category
     */
    protected $currentNav;
    /**
     * @var Category
     */
    protected $topNav;
    public function getAllNav()
    {
        if(is_null($this->allNav)){
            $this->allNav = Category::nav()->topCategories()->with(['children'=>function($query){
                $query->nav();
            }])->ordered()->ancient()->get();
        }
        return $this->allNav;
    }

    public function getAllNavFromCache()
    {
        return $this->getAllNav();
    }
    /**
     * 获取当前导航
     * @param Request $request
     * @return Category
     */
    public function setCurrentNav(Category $currentNav)
    {
        if (!$currentNav->isTopCategory()) {
            $this->topNav = $currentNav->parent;
        } else {
            $this->topNav = $currentNav;
        }
        $this->currentNav = $currentNav;
    }

    /**
     * 获取当前导航
     * @param Request $request
     * @return Category
     */
    public function getCurrentNav()
    {
        return $this->currentNav;
    }

    /**
     * 获取当前导航的顶级导航
     * @param Request $request
     * @return Category
     */
    public function getTopNav()
    {
        return $this->topNav;
    }

    public function getChildrenNav()
    {
        return $this->getAllNavFromCache()->where('id', $this->topNav->id)->first()->children;
    }
}