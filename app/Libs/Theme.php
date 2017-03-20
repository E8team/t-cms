<?php
namespace App\Libs;

use App\Entities\Setting;
use Storage;
use View;

class Theme
{
    private static $_instance = null;
    private $storage;
    private $defaultTheme = null;
    private $isAddedNamespace = false;

    private function __construct()
    {
        $this->storage = Storage::disk('theme');
    }

    private function __clone()
    {
    }

    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self ();
        }
        return self::$_instance;
    }

    public function getAllThemeInfo()
    {
        $themesPath = $this->storage->directories();
        $themeInfos = [];
        foreach ($themesPath as $theme) {
            if ($this->storage->exists($theme . '/config.json')) {
                $themeInfos[] = json_decode($this->storage->get($theme . '/config.json'), true);
            }
        }
        return $themeInfos;
    }

    public function getTemplateInfo($name = null)
    {
        if (is_null($name)) {
            $name = $this->getDefaultTheme();
        }
        $templateInfo = [];
        if ($this->storage->exists($name . '/config.json')) {
            $templateInfo = json_decode($this->storage->get($name . '/config.json'), true);
        }
        return $templateInfo;
    }

    public function getDefaultTheme()
    {
        if (is_null($this->defaultTheme)) {
            $this->defaultTheme = Setting::getSetting('current_theme');
            if(is_null($this->defaultTheme))
                $this->defaultTheme = 'defalut';
        }
        return $this->defaultTheme;
    }

    public function addNamespace()
    {
        if(!$this->isAddedNamespace)
        {
            $defaultTheme = $this->getDefaultTheme();
            View::addNamespace($defaultTheme, config('filesystems.disks.theme.root') . '/' . $defaultTheme);
            $this->isAddedNamespace = true;
        }
    }

    public function view($view, $data = [], $mergeData = [])
    {
        $this->addNamespace();
        return View::make($this->getDefaultTheme() . '::' . $view, $data, $mergeData);
    }
}