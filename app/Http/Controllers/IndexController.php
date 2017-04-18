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
        $postList = $currentCategory->postList()->paginate($this->perPage());
        $postList->appends($request->all());
        return theme_view($currentCategory->list_template, [
            'postList' => $postList
        ]);
    }


    public function post($cateSlug, Post $post)
    {
        $category = Category::findBySlug($cateSlug);
        app(Navigation::class)->setCurrentNav($category);
        return theme_view($post->template, ['post' => $post]);
    }
}