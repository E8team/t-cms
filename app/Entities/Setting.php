<?php

namespace App\Entities;

use App\Entities\Traits\Cachable;
use Cache;

class Setting extends BaseModel
{
    use Cachable;

    protected $fillable = ['name', 'value', 'description', 'is_autoload'];

    protected $casts = [
        'is_autoload' => 'boolean',
    ];

    protected function clearCache()
    {
        if ($this->is_autoload) {
            Cache::forget('setting_autoload');
        } else {
            Cache::forget('setting_' . $this->name);
        }
    }

    public static function allSetting($isAutoload = null)
    {
        if(!is_null($isAutoload)){
            $query = static::where('is_autoload', (boolean)$isAutoload);
        }else{
            $query = static::query();
        }
        return $query->recent()
            ->get()
            ->keyBy('name');
    }

    public static function allSettingWithCache()
    {
        return Cache::rememberForever('setting_autoload', function () {
            return static::allSetting();
        });
    }

    public static function getSetting($name)
    {
        $value = static::allSettingWithCache()->get($name);
        if (is_null($value)) {
            $value = Cache::rememberForever('setting_' . $name, function () use ($name) {
                return static::where('name', $name)->first();
            });
        }
        return $value;
    }
}
