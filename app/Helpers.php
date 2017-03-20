<?php

/**
 * 获取当前主题的视图
 * @param $view
 * @param array $data
 * @param array $mergeData
 * @return \Illuminate\Contracts\View\View
 */
function theme_view($view, $data = [], $mergeData = [])
{
    return \App\Libs\Theme::getInstance()->view($view, $data, $mergeData);
}