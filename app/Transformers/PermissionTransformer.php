<?php

namespace App\Transformers;

use App\Entities\Permission;
use League\Fractal\TransformerAbstract;

class PermissionTransformer extends TransformerAbstract
{
    public function transform(Permission $permission)
    {
        return [
            'id' => $permission->id,
            'name' => $permission->name,
            'display_name' => $permission->display_name,
            'description' => $permission->description,
            'parent_id' => $permission->parent_id,
            'is_menu' => $permission->is_menu,
            'icon' => $permission->icon,
            'order' => $permission->orders,
            'created_at' => $permission->created_at->toDateTimeString(),
            'updated_at' => $permission->updated_at->toDateTimeString()
        ];
    }
}
