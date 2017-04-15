<?php


namespace App\T\Navigation;


use App\Entities\Category;

class Navigation
{
    public function getNav()
    {
        $allNav = Category::nav()->orderBy('parent_id', 'ASC')->ordered()->recent()->get()->toArray();
        $res = [];
        $this->treeByArray($allNav, $res);
        return $res;
    }

    public function getNavFromCache()
    {
        return $this->getNav();
    }

    private  function treeByArray(&$allNav, &$res, $parentId = 0)
    {
        $i = 0;
        foreach ($allNav as $key => $value) {
            if ($value['parent_id'] == $parentId) {
                $res[$i] = $value;
                $res[$i]['children'] = [];
                unset($allNav[$key]);
                self::treeByArray($allNav, $res[$i]['children'], $value['id']);
                $i++;
            }
        }
    }
}