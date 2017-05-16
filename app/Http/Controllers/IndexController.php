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
        $category = Category::findBySlug($cateSlug);

        app(Navigation::class)->setActiveNav($category);

        if ($category->isPostList()) {
            return $this->showList($category, $request);
        } else {
            return $this->showPage($category);
        }
    }

    private function showList(Category $category, Request $request)
    {
        $postList = $category->postListWithOrder($request->get('order'))->with('user')->paginate($this->perPage());
        $postList->appends($request->all());
        return theme_view(
            $category->list_template, [
            'postList' => $postList,
            ]
        );
    }

    private function showPage(Category $category)
    {
        $page = $category->page();
        if (is_null($page)) {
            //todo
            abort(404, '该单页还没有初始化');
        }
        return theme_view($category->page_template, ['pagePost' => $page]);
    }

    /**
     * 正文
     *
     * @param  $cateSlug
     * @return \Illuminate\Contracts\View\View
     */
    public function post($cateSlug, $post)
    {
        $category = Category::findBySlug($cateSlug);
        $queryBuilder = $category->posts()->post()->where('id', $post);
        if (Auth::check() && Auth::user()->can('admin.post.show')) {
            $post = $queryBuilder->where(
                function ($query) {
                    $query->publishAndDraft();
                }
            )->withTrashed()->firstOrFail();
            if (!$post->isPublish() || $post->trashed()) {
                // 管理员预览草稿或未发布的文章
                Alert::setWarning('当前文章未发布，此页面只有管理员可见!');
            }
        } else {
            $post = $queryBuilder->publish()->firstOrFail();
        }
        app(Navigation::class)->setActiveNav($category);
        return theme_view($post->template, ['post' => $post]);
    }
}
