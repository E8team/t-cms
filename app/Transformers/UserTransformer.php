<?php

namespace App\Transformers;

use App\Entities\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    protected $availableIncludes  = ['roles'];

    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'user_name' => $user->user_name,
            'nick_name' => $user->nick_name,
            'email' => $user->email,
            'is_locked' => $user->is_locked,
            'avatar' => $user->avatar,
            'avatar_urls' => $user->avatar_urls,
            'created_at' => $user->created_at->toDateTimeString(),
            'updated_at' => $user->updated_at->toDateTimeString()
        ];
    }

    public function includeRoles(User $user)
    {
        $roles = $user->roles;
        return $this->collection($roles, new RoleTransformer());
    }
}
