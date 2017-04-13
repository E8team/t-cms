<?php
/**
 * 网站主题
 */

namespace App\Http\Controllers\Admin\Api;


use App\Entities\Setting;
use Illuminate\Http\Request;
use Ty666\LaravelTheme\Exception\ThemeNotFound;
use Ty666\LaravelTheme\Theme;

class ThemesController extends ApiController
{
    protected $currentThemeSettingName = 'current_theme';
    /**
     * 获取主题文件夹下面的主题列表
     */
    public function lists()
    {
        return app(Theme::class)->getAllThemeConfig();
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

    public function setCurrentTheme(Request $request)
    {
        $themeId = $request->get('theme_id');
        if(is_null($themeId)){
            return $this->response->errorBadRequest(trans('theme_not_found'));
        }
        try{
            app(Theme::class)->getThemeConfig($themeId);
        }catch (ThemeNotFound $e){
            return $this->response->errorBadRequest(trans('theme_not_found'));
        }
        $setting = Setting::firstOrNew(['name' => $this->currentThemeSettingName]);
        $setting->fill([
            'value' => $themeId,
            'description' => '当前主题',
            'is_autoload' => true
        ]);
        $setting->saveOrFail();
        return $this->response->noContent();
    }
}