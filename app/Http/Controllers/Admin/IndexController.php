<?php

namespace App\Http\Controllers\Admin;

class IndexController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function theme($themeId)
    {
        //todo
        abort('404');
    }
}
