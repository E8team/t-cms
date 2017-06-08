<?php

namespace App\Models;


class CachePage extends BaseModel
{
    protected $fillable = ['is_cache_forever', 'cache_time'];
    protected $casts = [
        'is_cache_forever' => 'boolean'
    ];
}
