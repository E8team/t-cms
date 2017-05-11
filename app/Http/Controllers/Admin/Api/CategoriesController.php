<?php

namespace App\Http\Controllers\Admin\Api;

use App\Models\Category;
use App\Models\Presenters\PostPresenters;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Transformers\CategoryTransformer;
use App\Transformers\PostTransformer;
use Illuminate\Http\Request;
use DB;

class CategoriesController extends ApiController
{
    public function __construct()
    {
        $this->middleware('permission:admin.post.categories')->except('post');
        $this->middleware('permission:admin.post.show')->only('post', 'page');
    }

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
        $data = filterNullWhenHasDefaultValue($request->all(), ['parent_id', 'order']);
        if (is_null($data['parent_id'])) {
            unset($data['parent_id']);
        }
        Category::create($data);
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
            ->ancient()
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
        if (!$category->isPostList()) {
            //todo 国际化
            return $this->response->errorNotFound('该栏目不是列表栏目');
        }
        // 这一步为了获取文章url
        PostPresenters::setActiveCategory($category);
        $posts = $category->posts()
            ->applyFilter($request)
            ->with('user')
            ->paginate($this->perPage());
        return $this->response->paginator($posts, new PostTransformer());
    }

    public function page(Category $category)
    {
        if (!$category->isPage()) {
            //todo 国际化
            return $this->response->errorNotFound('该栏目不是单网页');
        }
        return $this->response->item($category->page(), new PostTransformer());
    }

    public function getAllCategory(Request $request)
    {
        if ($request->get('show') == 'indent') {
            //$indentStr = $request->get('indent_str');
            return $this->response->array(Category::allCategoryIndent($request->get('type'), '　∟　'));
        } else {
            return $this->response->array(Category::allCategoryArray($request->get('type')));
        }
    }

    /**
     * 删除分类
     * @param Category $category
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function destroy(Category $category, Request $request)
    {
        if ($request->has('delete_relation')) {
            // 需要删除关联数据
            $category->posts()->forceDelete();
        }
        DB::table('category_post')->where('category_id', $category->id)->delete();
        $category->delete();
        return $this->response->noContent();
    }
}
