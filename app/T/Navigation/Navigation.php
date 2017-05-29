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
     * 获取当前所在的子导航的顶级导航
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
        // 这里不直接 return $this->topNav->children() 的原因是为了从缓存中获取数据
        $topNav = $this->getAllNavFromCache()->where('id', $this->topNav->id)->first();
        if(!is_null($topNav)){
            return $topNav->children;
        }else{
            return collect();
        }

    }
}
