<?php


namespace App\T\Navigation;

use App\Models\Category;

class Navigation
{
    protected $allNav = null;
    /**
     * @var Category
     */
    protected $activeNav;
    /**
     * @var Category
     */
    protected $topNav;

    public function getAllNav()
    {
        if (is_null($this->allNav)) {
            $this->allNav = Category::nav()->topCategories()->with(
                ['children' => function ($query) {
                    $query->nav();
                }]
            )->ordered()->ancient()->get();
        }
        return $this->allNav;
    }

    public function getAllNavFromCache()
    {
        return $this->getAllNav();
    }

    /**
     * 获取当前导航
     *
     * @param  Request $request
     * @return Category
     */
    public function setActiveNav(Category $activeNav)
    {
        if (!$activeNav->isTopCategory()) {
            $this->topNav = $activeNav->parent;
        } else {
            $this->topNav = $activeNav;
        }
        $this->activeNav = $activeNav;
    }

    /**
     * 获取当前导航
     *
     * @param  \Illuminate\Http\Request $request
     * @return Category
     */
    public function getActiveNav()
    {
        return $this->activeNav;
    }

    /**
     * 获取当前导航的顶级导航
     *
     * @param  \Illuminate\Http\Request $request
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
