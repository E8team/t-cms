<?php /* 辅助函数 */


/**
 * 获取站点设置
 *
 * @param  null $key
 * @param  null $default
 * @return mixed|null
 */
function setting($key = null, $default = null)
{
    static $allSetting = null;
    if (is_null($allSetting)) {
        $allSetting = \App\Models\Setting::allSettingWithCache();
    }
    if (is_null($key)) {
        return $allSetting;
    }

    if ($allSetting->has($key)) {
        if($setting = $allSetting->get($key)){
            return $setting->value;
        }else{
            return $setting;
        }
    }

    return $default;
}

function isSameHost($url)
{
    return app(\Illuminate\Http\Request::class)->getHost() == parse_url($url, PHP_URL_HOST);
}