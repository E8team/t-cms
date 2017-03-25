<?php

namespace App\Http\Controllers\Admin;

use App\Entities\User;
class IndexController extends Controller
{
    public function index()
    {
        User::all();
    }
}