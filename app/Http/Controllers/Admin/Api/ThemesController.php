<?php
/**
 * 网站主题
 */

namespace App\Http\Controllers\Admin\Api;

use App\Models\Setting;
use Illuminate\Http\Request;
use Ty666\LaravelTheme\Exception\ThemeNotFound;
use Ty666\LaravelTheme\ThemeManager;

class ThemesController extends ApiController
{
    public function __construct()
    {
        $this->middleware('permission:admin.setting.theme');
    }

    /**
     * 获取主题文件夹下面的主题列表
     */
    public function lists()
    {
        $theme = app(ThemeManager::class);
        $activeThemeId = $theme->getActiveTheme();
        $allThemeConfig = $theme->getAllThemeConfig();
        foreach ($allThemeConfig as &$themeConfig) {
            if ($themeConfig['theme_id'] == $activeThemeId) {
                $themeConfig['is_active'] = true;
                break;
            }
        }
        return $allThemeConfig;
    }

    public function contentTemplate()
    {
        $contentTemplates = app(ThemeManager::class)->getActiveThemeConfig()['content_template'];
        foreach ($contentTemplates as &$contentTemplate) {
            $contentTemplate['title'] .= "({$contentTemplate['file_name']})";
        }
        unset($contentTemplate);
        return $this->response->array($contentTemplates);
    }

    public function activeThemeConfig()
    {
        $activeThemeConfig = app(ThemeManager::class)->getActiveThemeConfig();
        foreach ($activeThemeConfig as $key => &$value) {
            if (ends_with($key, '_template')) {
                foreach ($value as &$template) {
                    $template['title'] .= "({$template['file_name']})";
                }
                unset($template);
            }
        }
        unset($value);
        return $activeThemeConfig;
    }

    public function setActiveTheme(Request $request)
    {
        $themeId = $request->get('theme_id');
        if (is_null($themeId)) {
            return $this->response->errorBadRequest(trans('theme_not_found'));
        }
        try {
            app(ThemeManager::class)->getThemeConfig($themeId);
        } catch (ThemeNotFound $e) {
            return $this->response->errorBadRequest(trans('theme_not_found'));
        }
        $setting = Setting::firstOrNew(['name' => $this->activeThemeSettingName]);
        $setting->fill(
            [
            'value' => $themeId,
            'description' => '当前主题',
            'is_autoload' => true
            ]
        )->saveOrFail();
        return $this->response->noContent();
    }
}
