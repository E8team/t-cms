<?php
/**
 * 站点设置
 */

namespace App\Http\Controllers\Admin\Api;


use App\Entities\Setting;
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
        $data = $request->all();
        $data = filterNullWhenHasDefaultValue($data, 'is_autoload');
        Setting::create($data);
        return $this->response->noContent();
    }

    public function update(Setting $setting, SettingUpdateRequest $request)
    {
        $request->performUpdate($setting);
        return $this->response->noContent();
    }

}