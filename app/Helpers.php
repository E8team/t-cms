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
    return app(\App\Libs\Theme::class)->view($view, $data, $mergeData);
}