<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Requests\CachePageUpdateRequest;
use App\Models\CachePage;
use App\Transformers\CachePageTransformer;
use Cache;

class CacheController extends ApiController
{
    public function cachePages()
    {
        $cachePages = CachePage::ordered()->ancient()->get();
        return $this->response->collection($cachePages, new CachePageTransformer());
    }

    public function clearCache(CachePage $cachePage)
    {
        Cache::pull('cache_page:'.$cachePage->route_name);
        return $this->response->noContent();
    }

    public function show(CachePage $cachePage)
    {
        return $this->item($cachePage, new CachePageTransformer());
    }

    public function update(CachePage $cachePage,CachePageUpdateRequest $cachePageUpdateRequest)
    {
        $cachePageUpdateRequest->performUpdate($cachePage);
        Cache::pull("cache_page:{$cachePage->route_name}:table");
        return $this->response->noContent();
    }
}