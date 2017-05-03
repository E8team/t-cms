<?php

namespace App\Transformers;

use App\Models\Type;
use League\Fractal\TransformerAbstract;

class TypeTransformer extends TransformerAbstract
{
    public function transform(Type $type)
    {
        return [
            'id' => $type->id,
            'name' => $type->name,
            'description' => $type->description,
            'order' => $type->order,
        ];
    }
}
