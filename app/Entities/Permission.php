<?php

namespace App\Entities;


use App\Entities\Traits\Cachable;
use App\Entities\Traits\Listable;
use Cache;
use Config;
use Zizaco\Entrust\Contracts\EntrustPermissionInterface;
use Zizaco\Entrust\Traits\EntrustPermissionTrait;

class Permission extends BaseModel implements EntrustPermissionInterface
{
    use EntrustPermissionTrait, Cachable, Listable;
    protected $casts = [
        'is_menu' => 'boolean'
    ];
    protected $fillable = ['name', 'display_name', 'description', 'parent_id', 'is_menu', 'icon', 'order'];
    protected static $allowSortFields = ['name', 'display_name', 'is_menu', 'order'];
    protected static $allowSearchFields = ['name', 'display_name'];

    protected function clearCache()
    {
        Cache::tags(Config::get('permissions_table'))->flush();
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
        return static::Ordered()
            ->recent()
            ->get()
            ->keyBy('id');
        //->groupBy('parent_id'); 如果需要groupBy请调用allPermissionWithCache()后自行groupBy()
    }

    public static function allPermissionWithCache()
    {
        return Cache::tags(Config::get('permissions_table'))->rememberForever('permissions', function () {
            return static::allPermission();
        });
    }

    public static function getUserMenu($user)
    {

        if (is_numeric($user)) {
            $user = User::find($user);
        }
        if (!$user instanceof User) {
            return null;
        }

        $menu = collect();
        $user->roles->each(function ($item) use (&$menu) {
            $menu = $menu->merge($item->cachedPermissions());
        });
        if ($menu->isEmpty()) {
            return $menu;
        }
        return $menu->sortBy('order')->sortBy('created_at')->groupBy('parent_id');
    }

    public function scopeTopPermissions($query)
    {
        return $query->where('parent_id', 0);
    }

    public function scopeChildrenPermissions($query, $parentId)
    {
        return $query->where('parent_id', $parentId);
    }

    public static function movePermissions2Roles($permissionIds, $roleIds)
    {
        $permissions = static::findOrFail($permissionIds);
        $roleIds = Role::findOrFail($roleIds)->pluck('id');
        $permissions->each(function ($permission) use ($roleIds) {
            $permission->roles()->sync($roleIds);
        });
    }
}