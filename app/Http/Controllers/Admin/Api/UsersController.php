<?php

namespace App\Http\Controllers\Admin\Api;

use App\Entities\User;
use App\Http\Requests\Request;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Transformers\RoleTransformer;
use App\Transformers\UserTransformer;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Hash;
use Auth;

class UsersController extends ApiController
{
    public function me()
    {
        return $this->response->item(Auth::user(), new UserTransformer());
    }

    public function lists()
    {
        $users = User::withSimpleSearch()
            ->withSort()
            ->recent()
            ->paginate($this->perPage());
        return $this->response->paginator($users, new UserTransformer())
            ->setMeta(User::getAllowSortFieldsMeta() + User::getAllowSearchFieldsMeta());
    }

    public function show(User $user)
    {
        return $this->response->item($user, new UserTransformer());
    }

    public function destroy($id)
    {
        if (!User::destroy(intval($id))) {
            //todo 国际化
            throw new NotFoundHttpException('该用户不存在');
        }
        return $this->response->noContent();
    }

    public function update(User $user, UserUpdateRequest $request)
    {
        $data = $request->all();
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        $request->performUpdate($user);
        return $this->response->noContent();
    }

    public function store(UserCreateRequest $request)
    {
        $data = $request->all();
        if(empty($data['password'])){
            unset($data['password']);
        }else{
            $data['password'] = Hash::make($data['password']);
        }

        User::create($data);
        return $this->response->noContent();
    }

    public function roles(User $user)
    {
        return $this->response->collection($user->roles, new RoleTransformer());
    }

    public function moveUsers2Roles(Request $request)
    {
        $this->validate($request, [
            'user_ids' => 'int_array',
            'role_ids' => 'int_array',
        ]);
        $userIds = $request->get('user_ids');
        $roleIds = $request->get('role_ids');

    }
}