<?php

namespace App\Repositories;


use App\Models\Category;

class CategoryRepository
{
    /**
     * 通过slug来查找分类
     *
     * @param  $slug
     * @return Category
     */
    public function findBySlug($slug)
    {
        return Category::where('cate_slug', $slug)->firstOrFail();
    }

    /*public function allCategory()
    {
        $allMenu = Category::orderBy('parent_id', 'ASC')->ordered()->ancient()->get()->toArray();
        $res = [];
        $this->treeByArray($allMenu, $res);
        return $res;
    }*/



    public function allCategoryArray($type = null)
    {
        $allCategory = Category::byType($type)->orderBy('parent_id', 'ASC')->ordered()->ancient()->get()->toArray();
        $res = [];
        $this->treeByArray($allCategory, $res);
        return $res;
    }

    public function allCategoryIndent($type = null, $indentStr = '-')
    {
        if (is_null($indentStr)) {
            $indentStr = '-';
        }
        $allCategory = Category::byType($type)->orderBy('parent_id', 'ASC')->ordered()->ancient()->get()->toArray();
        $res = [];
        $this->treeByIndent($allCategory, $res, $indentStr, 0, 0);
        return $res;
    }


    private function treeByArray(&$allNav, &$res, $parentId = 0)
    {
        $i = 0;
        foreach ($allNav as $key => $value) {
            if ($value['parent_id'] == $parentId) {
                $res[$i] = $value;
                $res[$i]['children'] = [];
                unset($allNav[$key]);
                $this->treeByArray($allNav, $res[$i]['children'], $value['id']);
                $i++;
            }
        }
    }

    private function treeByIndent(&$allNav, &$res, $indentStr = '-', $parentId = 0, $level = 0)
    {
        foreach ($allNav as $key => $value) {
            if ($value['parent_id'] == $parentId) {
                $value['level'] = $level;
                $value['indent_str'] = str_repeat($indentStr, $level);
                $res[] = $value;
                $this->treeByIndent($allNav, $res, $indentStr, $value['id'], $level + 1);
            }
        }
    }
}
