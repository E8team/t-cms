<?php
namespace App\Libs;


use View;

class Theme
{
    private $storage;
    private $currentTheme;
    private $isAddedNamespace = false;

    public function __construct($storage, $currentTheme)
    {
        $this->storage = $storage;
        $this->currentTheme = is_null($currentTheme)?'default':$currentTheme;
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
            $name = $this->currentTheme;
        }
        $templateInfo = [];
        if ($this->storage->exists($name . '/config.json')) {
            $templateInfo = json_decode($this->storage->get($name . '/config.json'), true);
        }
        return $templateInfo;
    }



    public function addNamespace()
    {
        if(!$this->isAddedNamespace)
        {
            View::addNamespace($this->currentTheme, config('filesystems.disks.theme.root') . '/' . $this->currentTheme);
            $this->isAddedNamespace = true;
        }
    }

    public function view($view, $data = [], $mergeData = [])
    {
        $this->addNamespace();
        return View::make($this->currentTheme . '::' . $view, $data, $mergeData);
    }
}