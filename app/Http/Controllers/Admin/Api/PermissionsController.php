<?php


namespace App\Http\Controllers\Admin\Api;


use App\Entities\Permission;
use App\Entities\User;
use Auth;

class PermissionsController extends ApiController
{
    public function menus()
    {
        return Permission::getUserMenu(Auth::user());
    }

    public function lists()
    {

    }
}