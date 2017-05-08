<?php  /* 辅助函数 */

/**
 * 过滤值为null的数组
 * @param $data
 * @param $keyList
 * @return mixed
 */
function filterNullWhenHasDefaultValue($data, $keyList)
{
    if (is_string($keyList)) {
        $keyList = [$keyList];
    }
    foreach ($keyList as $key) {
        if (array_key_exists($key, $data) && is_null($data[$key])) {
            unset($data[$key]);
        }
    }
    return $data;
}

/**
 * 获取站点设置
 * @param null $key
 * @param null $default
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
    if (array_key_exists($key, $allSetting)) {
        return $allSetting[$key];
    }
    return $default;
}
