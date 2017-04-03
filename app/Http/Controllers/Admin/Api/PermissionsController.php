<?php


namespace App\Http\Controllers\Admin\Api;


use App\Entities\Permission;
use App\Http\Requests\PermissionCreateRequest;
use App\Http\Requests\PermissionUpdateRequest;
use App\Transformers\PermissionTransformer;
use Auth;
use Illuminate\Http\Request;

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
        /*return $this->response->collection(
            Permission::allPermissionWithCache()->where('parent_id', 0),
            new PermissionTransformer());*/
        $topPermissions = Permission::topPermissions()
            ->withSimpleSearch()
            ->ordered()
            ->recent()
            ->get();
        return $this->response->collection($topPermissions, new PermissionTransformer())
            ->setMeta(Permission::getAllowSearchFieldsMeta());

    }

    public function getChildren(Permission $permission)
    {
        /*$permissions = Permission::allPermissionWithCache()->where('parent_id', $permission->id);
        return $this->response->collection($permissions, new PermissionTransformer());*/
        $childrenPermissions = Permission::childrenPermissions($permission->id)
            ->withSimpleSearch()
            ->ordered()
            ->recent()
            ->get();
        return $this->response->collection($childrenPermissions, new PermissionTransformer())
            ->setMeta(Permission::getAllowSearchFieldsMeta());
    }

    public function store(PermissionCreateRequest $request)
    {
        Permission::create($request->all());
        return $this->response->noContent();
    }

    public function update(Permission $permission, PermissionUpdateRequest $request)
    {
        $request->performUpdate($permission);
        return $this->response->noContent();
    }

    public function movePermissions2Roles(Request $request) {
        $this->validate($request, [
            'permission_ids' => 'int_array',
            'role_ids' => 'int_array'
        ]);
        $permissionIds = $request->get('permission_ids');
        $roleIds = $request->get('role_ids');
        Permission::movePermissions2Roles($permissionIds, $roleIds);
        return $this->response->noContent();
    }
}