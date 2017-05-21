<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Auth;

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
}
