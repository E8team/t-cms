<?php

namespace App\Http\Controllers;


use App\Entities\Category;

class IndexController extends Controller
{
    public function index()
    {
        return theme_view('index');
    }
    public function postList($cateSlug)
    {
        $category = Category::findBySlug($cateSlug);
        dd($category->toArray());
        //return theme_view('')
    }
}