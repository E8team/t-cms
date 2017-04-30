<?php
namespace App\Entities\Traits;

use App\Entities\Type;

Trait Typeable{
    public function scopeByType($query, $type)
    {
        if ($type instanceof Type) {
            $typeId = $type->id;
        } elseif (is_array($type)) {
            $typeId = $type['id'];
        } elseif (is_null($type)){
            $typeId = null;
        }else{
            $typeId = intval($type);
        }

        return $query->where('type_id', $typeId);
    }
}