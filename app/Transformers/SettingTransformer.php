<?php

namespace App\Transformers;

use App\Models\Link;
use App\Models\Setting;
use League\Fractal\TransformerAbstract;

class SettingTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['type'];

    public function transform(Setting $setting)
    {
        return [
            'id' => $setting->id,
            'name' => $setting->name,
            'value' => $setting->value,
            'description' => $setting->description,
            'is_autoload' => $setting->is_autoload,
            'created_at' => $setting->created_at->toDateTimeString(),
            'updated_at' => $setting->updated_at->toDateTimeString()
        ];
    }

    public function includeType(Setting $setting)
    {
        $type = $setting->type;
        return $this->item($type, new TypeTransformer());
    }
}
