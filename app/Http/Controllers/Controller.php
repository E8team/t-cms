<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function perPage($default = null)
    {
        $maxPerPage = config('app.max_per_page');
        $perPage = (request('per_page') ?: $default) ?: config('app.default_per_page');
        return (int)($perPage < $maxPerPage ? $perPage : $maxPerPage);
    }
}
