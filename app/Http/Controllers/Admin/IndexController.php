<?php

namespace App\Http\Controllers\Admin;



use App\Entities\Permission;

class IndexController extends Controller
{
    public function index()
    {

        dd(Permission::getPermissionsArray());
    }
}