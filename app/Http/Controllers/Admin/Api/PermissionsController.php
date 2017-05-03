<?php


namespace App\Http\Controllers\Admin\Api;


use App\Models\Permission;
use App\Http\Requests\PermissionCreateRequest;
use App\Http\Requests\PermissionUpdateRequest;
use App\Transformers\PermissionTransformer;
use Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PermissionsController extends ApiController
{
    public function __construct()
    {
        $this->middleware('permission:admin.user.permissions')->except('menus');
    }

    /**
     * 获取后台菜单
     * @return mixed
     */
    public function menus()
    {
        $permissions = Permission::getUserMenu(Auth::user());
        $topPermissions = Permission::allPermissionWithCache();
        $topPermissions = $topPermissions->only($permissions->keys()->all())->keyBy('id')->toArray();
        foreach ($topPermissions as &$topPermission) {
            $topPermission['children'] = $permissions[$topPermission['id']];
        }
        unset($topPermission);
        return $this->response->array($topPermissions);
    }


    /**
     * 获取指定权限信息
     * @param Permission $permission
     * @return \Dingo\Api\Http\Response
     */
    public function show(Permission $permission)
    {
        return $this->response->item($permission, new PermissionTransformer());
    }

    /**
     * 获取所有权限(不分页 用于创建角色时显示)
     * @return mixed
     */
    public function allPermissions()
    {
        $permissions = Permission::allPermission()->groupBy('parent_id')->toArray();
        foreach ($permissions[0] as &$permission) {
            $permission['children'] = $permissions[$permission['id']];
            unset($permissions[$permission['id']]);
        }
        unset($permission);
        $permissions = $permissions[0];
        return $this->response->array($permissions);
    }

    /**
     * 获取一级权限
     * @return \Dingo\Api\Http\Response
     */
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

    /**
     * 获取子级权限
     * @param Permission $permission
     * @return \Dingo\Api\Http\Response
     */
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

    /**
     * 创建权限
     * @param PermissionCreateRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function store(PermissionCreateRequest $request)
    {
        $data = $request->all();
        $data = filterNullWhenHasDefaultValue($data, ['parent_id', 'order']);
        Permission::create($data);
        return $this->response->noContent();
    }

    /**
     * 更新权限
     * @param Permission $permission
     * @param PermissionUpdateRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function update(Permission $permission, PermissionUpdateRequest $request)
    {
        $request->performUpdate($permission);
        return $this->response->noContent();
    }

    /**
     * 批量移动权限
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function movePermissions2Roles(Request $request)
    {
        $this->validate($request, [
            'permission_ids' => 'int_array',
            'role_ids' => 'int_array'
        ]);
        $permissionIds = $request->get('permission_ids');
        $roleIds = $request->get('role_ids');
        Permission::movePermissions2Roles($permissionIds, $roleIds);
        return $this->response->noContent();
    }

    /**
     * 删除指定权限
     * @param Permission $permission
     * @return \Dingo\Api\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return $this->response->noContent();
    }
}