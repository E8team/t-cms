<?php
/**
 * Created by PhpStorm.
 * User: ty
 * Date: 2017/3/30 0030
 * Time: 下午 9:00
 */

namespace App\Http\Controllers\Admin\Api;


use App\Entities\User;
use App\Transformers\UserTransformer;

class UsersController extends ApiController
{
    public function lists()
    {
        $users = User::paginate($this->perPage());
        return $this->response->paginator($users, new UserTransformer());
    }
}