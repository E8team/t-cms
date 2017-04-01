<?php


namespace App\Http\Controllers\Admin\Api;


use App\Entities\Permission;
use App\Transformers\PermissionTransformer;
use Auth;

class PermissionsController extends ApiController
{
    public function menus()
    {
        $permissions = Permission::getUserMenu(Auth::user());

        $topPermissions = Permission::allPermissionWithCache();
        $topPermissions = $topPermissions->only($permissions->keys()->all())->keyBy('id')->toArray();
        foreach ($topPermissions as &$topPermission)
        {
            $topPermission['children'] = $permissions[$topPermission['id']];
        }
        unset($topPermission);
        return $topPermissions;
    }

    public function getTopPermissions()
    {
        return $this->response->collection(
            Permission::allPermissionWithCache()->where('parent_id', 0),
            new PermissionTransformer());
    }

    public function getChildren(Permission $permission)
    {
        $permissions = Permission::allPermissionWithCache()->where('parent_id', $permission->id);
        return $this->response->collection($permissions, new PermissionTransformer());
    }
}