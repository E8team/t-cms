<?php
/**
 * 站点设置
 */

namespace App\Http\Controllers\Admin\Api;

use App\Models\Setting;
use App\Http\Requests\SettingCreateRequest;
use App\Http\Requests\SettingUpdateRequest;

class SettingsController extends ApiController
{
    public function __construct()
    {
        $this->middleware('permission:admin.setting.configure');
    }

    public function lists()
    {
        dd(Setting::allSetting());
    }

    public function store(SettingCreateRequest $request)
    {
        Setting::create($request->all());
        return $this->response->noContent();
    }

    public function update(Setting $setting, SettingUpdateRequest $request)
    {
        $request->performUpdate($setting);
        return $this->response->noContent();
    }
}
