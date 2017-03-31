<?php

namespace App\Transformers;

class UserTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
            'id' => $model->id,
            'user_name' => $model->user_name,
            'nick_name' => $model->nick_name,
            'email' => $model->email,
            'is_locked' => $model->is_locked,
            'avatar' => $model->avatar,
            //'roles' => $model->roles,
            'created_at' => $model->created_at->toDateTimeString(),
            'updated_at' => $model->updated_at->toDateTimeString()
        ];
    }
}
