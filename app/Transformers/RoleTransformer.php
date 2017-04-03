<?php

namespace App\Transformers;

class RoleTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'display_name' => $model->display_name,
            'description' => $model->description,
            'order' => $model->order,
            'created_at' => $model->created_at->toDateTimeString(),
            'updated_at' => $model->updated_at->toDateTimeString()
        ];
    }
}
