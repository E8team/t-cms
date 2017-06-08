<?php

namespace App\Repositories;

use App\Models\CachePage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Cache;

class CachePageRepository
{
    public function getCachePageByRouteName($routeName)
    {
        return CachePage::where('route_name', $routeName)->firstOrFail();
    }

    public function getCachePageByRouteNameFromCache($routeName)
    {
        return Cache::rememberForever("cache_page:$routeName:table", function () use ($routeName){
            return $this->getCachePageByRouteName($routeName);
        });
    }

    public function needCache($routeName)
    {
        try {
            return $this->getCachePageByRouteNameFromCache($routeName);
        }catch(ModelNotFoundException $exception)
        {
            return false;
        }
    }
}