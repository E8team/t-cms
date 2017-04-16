<?php

namespace App\Http\Controllers;


use App\Entities\Category;
use App\Entities\Post;
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

        if (!$currentCategory->isTopCategory()) {
            $topCategory = $currentCategory->parent;
        } else {
            $topCategory = $currentCategory;
        }
        $topCategory->load(['children' => function ($query) {
            $query->nav();
        }]);
        $postList = $currentCategory->postList()->paginate($this->perPage());
        $postList->appends($request->all());
        return theme_view($currentCategory->list_template, [
            'topCategory' => $topCategory,
            'currentCategory' => $currentCategory,
            'postList' => $postList
        ]);
    }


    public function content(Post $post)
    {
        return theme_view($post->template, ['post' => $post]);
    }
}