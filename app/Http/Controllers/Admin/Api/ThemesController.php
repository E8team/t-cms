<?php
/**
 * 网站主题
 */

namespace App\Http\Controllers\Admin\Api;


use Ty666\LaravelTheme\Theme;

class ThemesController extends ApiController
{
    /**
     * 获取主题文件夹下面的主题列表
     */
    public function lists()
    {
        return app(Theme::class)->getAllThemeInfo();
    }

    public function contentTemplate()
    {
        $contentTemplates = app(Theme::class)->getCurrentThemeConfig()['content_template'];
        foreach ($contentTemplates as &$contentTemplate) {
            $contentTemplate['title'] .= "({$contentTemplate['file_name']})";
        }
        unset($contentTemplate);
        return $this->response->array($contentTemplates);
    }

    public function currentThemeConfig()
    {
        $currentThemeConfig = app(Theme::class)->getCurrentThemeConfig();
        foreach ($currentThemeConfig as $key => &$value) {
            if (ends_with($key, '_template')) {
                foreach ($value as &$template) {
                    $template['title'] .= "({$template['file_name']})";
                }
                unset($template);
            }
        }
        unset($value);
        return $currentThemeConfig;
    }

}