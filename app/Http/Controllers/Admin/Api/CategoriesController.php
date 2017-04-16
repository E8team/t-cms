<?php

namespace App\Http\Controllers\Admin\Api;


use App\Entities\Category;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Transformers\CategoryTransformer;
use App\Transformers\PostTransformer;
use Illuminate\Http\Request;

class CategoriesController extends ApiController
{

    public function show(Category $category)
    {
        return $this->response->item($category, new CategoryTransformer());
    }
    /**
     * 获取导航栏
     * @return array
     */
    public function nav()
    {
        return $this->response->array(Category::getNav());
    }

    /**
     * 创建分类
     * @param CategoryCreateRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function store(CategoryCreateRequest $request)
    {
        Category::create($request->all());
        return $this->response->noContent();
    }

    /**
     * 更新分类
     * @param Category $category
     * @param CategoryUpdateRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function update(Category $category, CategoryUpdateRequest $request)
    {
        $request->performUpdate($category);
        return $this->response->noContent();
    }

    /**
     * 获取一级分类
     * @return \Dingo\Api\Http\Response
     */
    public function getTopCategories(Request $request)
    {
        $topCategories = Category::topCategories()
            ->byType($request->get('type'))
            //->withSimpleSearch()
            ->ordered()
            ->recent()
            ->get();
        return $this->response->collection($topCategories, new CategoryTransformer());
            //->setMeta(Category::getAllowSearchFieldsMeta());

    }

    /**
     * 获取子级分类
     * @param Category $category
     * @return \Dingo\Api\Http\Response
     */
    public function getChildren(Category $category, Request $request)
    {
        $childrenCategories = $category->children()
            ->byType($request->get('type'))
            //->withSimpleSearch()
            ->get();
        return $this->response->collection($childrenCategories, new CategoryTransformer());
            //->setMeta(Category::getAllowSearchFieldsMeta());
    }

    /**
     * 获取指定分类下的文章
     * @param Category $category
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function posts(Category $category, Request $request)
    {
        $posts = $category->posts()
            ->applyFilter($request)
            ->with('user')
            ->paginate($this->perPage());
        return $this->response->paginator($posts, new PostTransformer());
    }

    public function getAllCategory(Request $request)
    {
        if($request->get('show') == 'indent'){
            //$indentStr = $request->get('indent_str');
            return $this->response->array(Category::allCategoryIndent($request->get('type'), '　∟　'));
        }else{
            return $this->response->array(Category::allCategoryArray($request->get('type')));
        }

    }
}