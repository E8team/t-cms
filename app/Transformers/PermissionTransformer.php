<?php

namespace App\Transformers;

class PermissionTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'display_name' => $model->display_name,
            'description' => $model->description,
            'parent_id' => $model->parent_id,
            'is_menu' => $model->is_menu,
            'icon' => $model->icon,
            'order' => $model->orders
        ];
    }
}
