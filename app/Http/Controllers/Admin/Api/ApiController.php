<?php
/**
 * Created by PhpStorm.
 * User: ty
 * Date: 2017/3/21 0021
 * Time: 下午 12:57
 */

namespace App\Http\Controllers\Admin\Api;
use App\Http\Controllers\Admin\Controller;
use Dingo\Api\Routing\Helpers;

class ApiController extends Controller
{
    use Helpers;

    function perPage($default = null)
    {
        $maxPerPage = config('app.max_per_page');
        $perPage = (request('per_page') ?: $default) ?: config('app.default_per_page');
        return (int) ($perPage < $maxPerPage ? $perPage : $maxPerPage);
    }
}