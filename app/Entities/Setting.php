<?php

namespace App\Entities;
use Cache;
class Setting extends BaseModel
{
    protected $fillable = ['name', 'value', 'is_autoload'];
    protected $casts = [
        'is_autoload' => 'boolean',
    ];
    private function clearCache()
    {
        if($this->is_autoload){
            Cache::forget('setting_autoload');
        }else{
            Cache::forget('setting_'.$this->name);
        }
    }
    public function save(array $options = [])
    {   //both inserts and updates
        if(!parent::save($options)){
            return false;
        }
        $this->clearCache();
        return true;
    }
    public function delete(array $options = [])
    {   //soft or hard
        if(!parent::delete($options)){
            return false;
        }
        $this->clearCache();
        return true;
    }
    public function restore()
    {   //soft delete undo's
        if(!parent::restore()){
            return false;
        }
        $this->clearCache();
        return true;
    }

    public static function allSetting()
    {
        return Cache::rememberForever('setting_autoload', function (){
            return static::where('is_autoload', true)
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
