<?php

namespace App\Http\Controllers;

use App\Repositories\CachePageRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Auth;
use Cache;
use Closure;
use Illuminate\Routing\Route;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 分页时每页显示多少数据
     *
     * @return int
     */
    public function perPage($default = null)
    {
        $maxPerPage = config('app.max_per_page');
        $perPage = (request('per_page') ?: $default) ?: config('app.default_per_page');
        return (int)($perPage < $maxPerPage ? $perPage : $maxPerPage);
    }

    public function rbacAuthorize($permission, $requireAll = false)
    {
        if (!Auth::user()->may($permission, $requireAll)) {
            throw new AuthorizationException('没有 '.$permission.' 权限');
        }
    }

    /**
     * 从缓存中获取页面
     */
    public function cache(Closure $callback)
    {
        $routeName = app(Route::class)->getName();
        $cachePage = app(CachePageRepository::class)->needCache($routeName);
        if($cachePage){
            $cacheKey = 'cache_page:'.$routeName;
            if($cachePage->is_cache_forever)
                return Cache::rememberForever($cacheKey, $callback);
            else
                return Cache::remember($cacheKey, $cachePage->cache_time, $callback);
        }else
            return $callback();
    }
}
