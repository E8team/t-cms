<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\T\Navigation\Navigation;
use Illuminate\Http\Request;
use Auth;
use Alert;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        return $this->postList('company-news', $request);
    }

    public function postList($cateSlug, Request $request)
    {
        $currentCategory = Category::findBySlug($cateSlug);

        app(Navigation::class)->setCurrentNav($currentCategory);

        if ($currentCategory->isPostList()) {
            return $this->showList($currentCategory, $request);
        } else {
            return $this->showPage($currentCategory);
        }

    }

    private function showList(Category $currentCategory, Request $request)
    {
        $postList = $currentCategory->postListWithOrder($request->get('order'))->paginate($this->perPage());
        $postList->appends($request->all());
        return theme_view($currentCategory->list_template, [
            'postList' => $postList,
        ]);
    }

    private function showPage(Category $currentCategory)
    {

        $page = $currentCategory->page();
        if(is_null($page)) {
            //todo
            abort(404, '该单页还没有初始化');
        }
        return theme_view($currentCategory->page_template, ['pagePost' => $page]);
    }

    /**
     * 正文
     * @param $cateSlug
     * @return \Illuminate\Contracts\View\View
     */
    public function post($cateSlug, $post)
    {

        $category = Category::findBySlug($cateSlug);
        $queryBuilder = $category->posts()->where('id', $post);
        if(Auth::check() && Auth::user()->can('admin.post.show')){
            $post = $queryBuilder->where(function ($query){
                $query->where('type', 'post')->orWhere('type', 'draft');
            })->firstOrFail();
            if(!$post->isPublish() || $post->isDraft())
            {
                // 管理员预览草稿或未发布的文章
                Alert::setWarning('当前文章未发布，此页面只有管理员可见!');
            }
        }else{
            $post = $queryBuilder->post()->publish()->firstOrFail();
        }
        app(Navigation::class)->setCurrentNav($category);
        return theme_view($post->template, ['post' => $post]);
    }
}