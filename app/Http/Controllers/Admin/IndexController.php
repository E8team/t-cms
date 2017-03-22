<?php

namespace App\Http\Controllers\Admin;


use App\Entities\Category;

class IndexController extends Controller
{
    public function index()
    {
        dd(Category::getMenu());
    }
}