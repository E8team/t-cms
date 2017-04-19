<?php

namespace App\Http\Controllers;


use App\Entities\Category;
use App\Entities\Post;
use App\T\Navigation\Navigation;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return theme_view('index');
    }

    public function postList($cateSlug, Request $request)
    {
        $currentCategory = Category::findBySlug($cateSlug);
        app(Navigation::class)->setCurrentNav($currentCategory);

        if ($currentCategory->isPostList()) {
            return $this->showList($currentCategory);
        } else {
            return $this->showPage($currentCategory);
        }

    }

    private function showList(Category $currentCategory, Request $request)
    {

        $postList = $currentCategory->postList()->paginate($this->perPage());
        $postList->appends($request->all());
        return theme_view($currentCategory->list_template, [
            'postList' => $postList
        ]);
    }

    private function showPage(Category $currentCategory)
    {
        return theme_view($currentCategory->page_template, ['pagePost' => $currentCategory->page()]);
    }

    public function post($cateSlug, Post $post)
    {
        $category = Category::findBySlug($cateSlug);
        app(Navigation::class)->setCurrentNav($category);
        return theme_view($post->template, ['post' => $post]);
    }
}