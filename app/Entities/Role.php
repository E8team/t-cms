<?php

namespace App\Entities;


use Zizaco\Entrust\Contracts\EntrustRoleInterface;
use Zizaco\Entrust\EntrustRole;
use Config;
use Zizaco\Entrust\Traits\EntrustRoleTrait;
use Cache;
use DB;

class Role extends BaseModel implements EntrustRoleInterface
{
    use EntrustRoleTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('entrust.roles_table');
    }

    public static function permissionRoleArrayWithCache()
    {
        return Cache::tag(Config::get('entrust.permission_role_table'))->rememberForever('all_permission_role', function () {
            return DB::table('permission_role')->get();
        });
    }

    public function cachedPermissions()
    {
        $rolePrimaryKey = $this->primaryKey;
        $cacheKey = 'entrust_permissions_for_role_'.$this->$rolePrimaryKey;
        return Cache::tags(Config::get('entrust.permission_role_table'))->rememberForever($cacheKey, function () {
            return $this->perms()->ordered()->recent()->get();
        });
    }
}