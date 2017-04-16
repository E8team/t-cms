<?php

namespace App\Http\Controllers;


use App\Entities\Category;
use App\Entities\Post;

class IndexController extends Controller
{
    public function index()
    {
        return theme_view('index');
    }

    public function postList($cateSlug)
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
        return theme_view($currentCategory->list_template, ['topCategory' => $topCategory, 'currentCategory' => $currentCategory]);
    }

    public function content(Post $post)
    {
        return theme_view($post->template, ['post' => $post]);
    }
}