<?php

namespace App\Http\Controllers\Admin;



use App\Entities\Permission;
use App\Entities\User;

class IndexController extends Controller
{
    public function index()
    {
        //dd(Permission::getUserMenu(User::find(1)));
    }
}