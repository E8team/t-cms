<?php

namespace App\Console\Commands\Tools;

class EnvSettingManager
{

    private $envContent = null;
    private $defaultSetting = [];

    public function __construct()
    {
        $this->readEnvFile();
        $this->envContent2Array();
    }

    public function getDefaultValue($key, $default = null)
    {
        if (isset($this->defaultSetting[$key])) {
            return $this->defaultSetting[$key];
        } else {
            return $default;
        }

    }

    private function envContent2Array()
    {
        if (!is_null($this->envContent)) {
            foreach (preg_split('/\s*\n+\s*/', trim($this->envContent)) as $item) {
                list($key, $value) = explode('=', $item, 2);
                $this->defaultSetting[$key] = $value;
            }
        }
    }

    private function envPath()
    {
        return base_path('.env');
    }

    private function exampleEnvPath()
    {
        return base_path('.env.example');
    }

    /**
     * @return string
     */
    private function readEnvFile()
    {
        if (is_null($this->envContent)) {
            $this->envContent = file_exists($this->envPath()) ? file_get_contents($this->envPath()) : file_get_contents($this->exampleEnvPath());
        }

        return $this->envContent;
    }

    public function setEnv($key, $value)
    {
        if ($this->envKeyExists($key)) {

            $this->replaceEnvKey($key, $value);
        } else {
            $this->appendEnv($key, $value);
        }

    }

    /**
     * @param $content
     */
    public function writeToEnv()
    {
        file_put_contents($this->envPath(), $this->envContent);
    }

    /**
     * @param $line
     * @param $keys
     * @return mixed
     */
    private function replaceEnvKey($key, $value)
    {

        $pattern = $this->buildPattern($key);
        if (preg_match($pattern, $this->envContent)) {
            $line = sprintf('%s=%s', $key, $value);
            $this->envContent = preg_replace($pattern, $line, $this->envContent, 1);
        }
    }

    /**
     * @param $configKey
     * @return string
     */
    private function buildPattern($configKey)
    {
        return '/' . $configKey . '[\t ]*=[\t ]*[^\r\n]*/';
    }

    /**
     * @param $key
     * @param $value
     */
    private function appendEnv($key, $value)
    {
        $line = sprintf("%s=%s" . PHP_EOL, $key, $value);
        $this->envContent .= $line;
    }


    /**
     * @param $key
     * @return bool
     */
    private function envKeyExists($key)
    {
        return strpos($this->readEnvFile(), $key) !== false;
    }

}