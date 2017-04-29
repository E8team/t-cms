<?php

/* 辅助函数 */
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