<?php
/**
 * 站点设置
 */

namespace App\Http\Controllers\Admin\Api;

use App\Models\Setting;
use App\Http\Requests\SettingCreateRequest;
use App\Http\Requests\SettingUpdateRequest;
use App\Models\Type;
use App\Transformers\SettingTransformer;

class SettingsController extends ApiController
{
    public function __construct()
    {
        $this->middleware('permission:admin.setting.configure');
    }

    public function allSettings()
    {
        $settings = Setting::ordered()
            ->recent()
            ->withSimpleSearch()
            ->withSort()
            ->paginate($this->perPage());
        return $this->response->paginator($settings, new SettingTransformer())
            ->setMeta(Setting::getAllowSortFieldsMeta() + Setting::getAllowSearchFieldsMeta());
    }

    public function lists(Type $type = null)
    {
        $settings = Setting::byType($type)
            ->ordered()
            ->recent()
            ->withSimpleSearch()
            ->withSort()
            ->paginate($this->perPage());
        return $this->response->paginator($settings, new SettingTransformer())
            ->setMeta(Setting::getAllowSortFieldsMeta() + Setting::getAllowSearchFieldsMeta());
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
