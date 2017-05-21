<?php

namespace App\Http\Controllers\Admin\Api;

use App\Models\Role;
use App\Models\User;
use App\Http\Requests\Request;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Transformers\RoleTransformer;
use App\Transformers\UserTransformer;
use Auth;
use Hash;

class UsersController extends ApiController
{
    public function __construct()
    {
        $this->middleware('permission:admin.user.show')->except('me');
    }

    /**
     * 当前登录的用户信息
     *
     * @return \Dingo\Api\Http\Response
     */
    public function me()
    {
        return $this->response->item(Auth::user(), new UserTransformer());
    }

    /**
     * 用户列表
     *
     * @return \Dingo\Api\Http\Response
     */
    public function lists()
    {
        $users = User::withSimpleSearch()
            ->withSort()
            ->recent()
            ->paginate($this->perPage());
        return $this->response->paginator($users, new UserTransformer())
            ->setMeta(User::getAllowSortFieldsMeta() + User::getAllowSearchFieldsMeta());
    }

    /**
     * 显示指定用户信息
     *
     * @param  User $user
     * @return \Dingo\Api\Http\Response
     */
    public function show(User $user)
    {
        $roleIds = $user->roles->pluck('id');
        return $this->response->item($user, new UserTransformer())
            ->addMeta('role_ids', $roleIds);
    }

    /**
     * 删除指定用户
     *
     * @param  User $user
     * @return \Dingo\Api\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return $this->response->noContent();
    }

    /**
     * 更新指定用户
     *
     * @param  User              $user
     * @param  UserUpdateRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function update(User $user, UserUpdateRequest $request)
    {
        $request->performUpdate(
            $user, function ($data) {
                if (isset($data['password'])) {
                    $data['password'] = Hash::make($data['password']);
                }
                return $data;
            }
        );
        if (!empty($roleIds = $request->get('role_ids'))) {
            $roleIds = Role::findOrFail($roleIds)->pluck('id');
            $user->roles()->sync($roleIds);
        }
        return $this->response->noContent();
    }

    /**
     * 创建用户
     *
     * @param  UserCreateRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $data = $request->all();
        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        $user = User::create($data);
        if (!empty($data['role_ids'])) {
            $roleIds = Role::findOrFail($data['role_ids'])->pluck('id');
            $user->roles()->sync($roleIds);
        }
        return $this->response->noContent();
    }

    /**
     * 获取当前用户的角色
     *
     * @param  User $user
     * @return \Dingo\Api\Http\Response
     */
    public function roles(User $user)
    {
        return $this->response->collection($user->roles, new RoleTransformer());
    }

    /**
     * 批量移动
     *
     * @param  Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function moveUsers2Roles(Request $request)
    {
        $this->validate(
            $request, [
            'user_ids' => 'int_array',
            'role_ids' => 'int_array',
            ]
        );
        $userIds = $request->get('user_ids');
        $roleIds = $request->get('role_ids');
        User::moveUsers2Roles($userIds, $roleIds);
        return $this->response->noContent();
    }
}
