<?php

namespace App\Http\Controllers\Admin\Api;

use App\Entities\User;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
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
            ->addMeta('allow_sort_fields', User::$allowSortFields)
            ->addMeta('allow_search_fields', User::$allowSearchFields);
    }

    public function show($id)
    {
        $user = User::find($id);
        $this->response->item($user, new UserTransformer());
    }

    public function destroy($id)
    {
        if (!User::destroy($id)) {
            //todo 国际化
            throw new NotFoundHttpException('该用户不存在');
        }
    }

    public function update(User $user, UserUpdateRequest $request)
    {
        $data = $request->all();
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        //$request->performUpdate(User::findOrFail($id));
    }

    public function store(UserCreateRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        User::create($data);
    }

}