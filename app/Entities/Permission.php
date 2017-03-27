<?php

namespace App\Entities;


use App\Entities\Traits\Cachable;
use Cache;
use Zizaco\Entrust\Contracts\EntrustPermissionInterface;
use Zizaco\Entrust\Traits\EntrustPermissionTrait;
use Config;

class Permission extends BaseModel implements EntrustPermissionInterface
{
    use EntrustPermissionTrait, Cachable;
    protected $fillable = [];
    protected function clearCache()
    {
        Cache::forget('permissions');
    }

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('entrust.permissions_table');
    }


    public static function allPermission()
    {
        return Cache::rememberForever('permissions', function () {
            return static::recent()
                ->get()
                ->keyBy('id');
        });
    }

    public static function getPermissionsArray()
    {
        $allPermission = static::allPermission();
        dd($allPermission);
    }
}