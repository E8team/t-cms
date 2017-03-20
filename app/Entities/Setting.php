<?php

namespace App\Entities;
use Cache;
class Setting extends BaseModel
{
    protected $fillable = ['name', 'value', 'is_autoload'];

    public static function allSetting()
    {
        return Cache::rememberForever('setting_autoload', function (){
            return static::where('is_autoload', false)
                ->recent()
                ->get()
                ->keyBy('name');
        });
    }
    public static function getSetting($name)
    {
        $value = static::allSetting()->get($name);
        if(is_null($value)){
            $value = Cache::rememberForever('setting_'.$name, function () use($name){
                return static::where('name', $name)->first();
            });
        }
        return $value;
    }
}
