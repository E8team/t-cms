<?php
/**
 * 网站主题
 */

namespace App\Http\Controllers\Admin\Api;


use App\Libs\Theme;

class ThemesController extends ApiController
{
    /**
     * 获取主题文件夹下面的主题列表
     */
    public function lists()
    {
        dd(app(Theme::class)->getAllThemeInfo());
    }
}