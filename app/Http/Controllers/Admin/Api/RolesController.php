<?php
namespace App\Http\Controllers\Admin\Api;

use App\Models\Permission;
use App\Models\Role;
use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Transformers\PermissionTransformer;
use App\Transformers\RoleTransformer;

class RolesController extends ApiController
{
    public function __construct()
    {
        $this->middleware('permission:admin.user.roles')->except('permissions');
        $this->middleware('permission:admin.user.permissions')->only('permissions');
    }

    /**
     * 显示指定角色
     * @param Role $role
     * @return \Dingo\Api\Http\Response
     */
    public function show(Role $role)
    {
        $permissionIds = $role->perms->pluck('id');
        return $this->response->item($role, new RoleTransformer())
            ->addMeta('permission_ids', $permissionIds);
    }

    /**
     * 获取所有角色(不分页 用于添加用户时显示)
     * @return \Dingo\Api\Http\Response
     */
    public function allRoles()
    {
        $roles = Role::ordered()->recent()->get();
        return $this->response->collection($roles, new RoleTransformer());
    }

    /**
     * 角色列表
     * @return \Dingo\Api\Http\Response
     */
    public function lists()
    {
        $roles = Role::withSimpleSearch()
            ->withSort()
            ->ordered()
            ->recent()
            ->paginate($this->perPage());
        return $this->response->paginator($roles, new RoleTransformer())
            ->setMeta(Role::getAllowSortFieldsMeta() + Role::getAllowSortFieldsMeta());
    }

    /**
     * 获取指定角色下面的权限
     * @param Role $role
     * @return \Dingo\Api\Http\Response
     */
    public function permissions(Role $role)
    {
        $permissions = $role->perms()->ordered()->recent()->get();
        return $this->response->collection($permissions, new PermissionTransformer());
    }

    /**
     * 创建角色
     * @param RoleCreateRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function store(RoleCreateRequest $request)
    {
        $data = $request->all();
        $data = filterNullWhenHasDefaultValue($data, 'order');
        $role = Role::create($data);
        if (!empty($data['permission_ids'])) {
            $permissionIds = Permission::findOrfail($data['permission_ids'])->pluck('id');
            $role->attachPermissions($permissionIds);
        }
        return $this->response->noContent();
    }

    /**
     * 更新角色
     * @param Role $role
     * @param RoleUpdateRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function update(Role $role, RoleUpdateRequest $request)
    {
        $request->performUpdate($role);
        $permissionIds = $request->get('permission_ids');
        if (!empty($permissionIds)) {
            $permissionIds = Permission::findOrfail($permissionIds)->pluck('id');
            $role->savePermissions($permissionIds);
        }
        return $this->response->noContent();
    }

    /**
     * 删除角色
     * @param Role $role
     * @return \Dingo\Api\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return $this->response->noContent();
    }
}
