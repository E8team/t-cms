<?php
/**
 * 站点设置
 */

namespace App\Http\Controllers\Admin\Api;


use App\Entities\Setting;

class SettingsController extends ApiController
{
    public function lists()
    {
        dd(Setting::allSetting());
    }

    public function store()
    {

    }
}