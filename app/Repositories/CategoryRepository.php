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

    private function type($type){
        switch ($type) {
            case 'post_list':
            case 'post': // 为了兼容
                return 0;
                break;
            case 'page':
                return 1;
                break;
            case 'ext_link':
                return 2;
                break;
        }
    }

    public function allCategoryArray($type = null)
    {
        $allCategory = Category::orderBy('parent_id', 'ASC')->ordered()->ancient()->get()->toArray();
        $res = [];
        $this->treeByArray($allCategory, $res);
        if(!is_null($type)){
            $type = $this->type($type);
            foreach ($res as $index => &$parent){

                foreach ($parent['children'] as $i => $category){
                    if($category['type'] != $type) {
                        unset($parent['children'][$i]);
                    }
                }

                if($parent['type']!=$type)
                {
                    if(count($parent['children'])<=0){
                        unset($res[$index]);
                    }
                }
            }
        }
        unset($parent);
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
        if(!is_null($type)){
            $type = $this->type($type);
            foreach ($res as $index => &$parent){

                foreach ($parent['children'] as $i => $category){
                    if($category['type'] != $type) {
                        unset($parent['children'][$i]);
                    }
                }

                if($parent['type']!=$type)
                {
                    if(count($parent['children'])<=0){
                        unset($res[$index]);
                    }
                }
            }
        }
        unset($parent);
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
