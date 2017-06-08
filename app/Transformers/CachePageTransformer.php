<?php

namespace App\Transformers;

use App\Models\Banner;
use App\Models\CachePage;
use League\Fractal\TransformerAbstract;

class CachePageTransformer extends TransformerAbstract
{
    public function transform(CachePage $cachePage)
    {
        return [
            'id' => $cachePage->id,
            'route_name' => $cachePage->route_name,
            'description' => $cachePage->description,
            'is_cache_forever' => $cachePage->is_cache_forever,
            'cache_time' => $cachePage->cache_time,
            'order' => $cachePage->order,
            'created_at' => $cachePage->created_at->toDateTimeString(),
            'updated_at' => $cachePage->updated_at->toDateTimeString()
        ];
    }
}
