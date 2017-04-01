<?php

namespace App\Entities;

use App\Entities\Traits\Listable;

class Category extends BaseModel
{
    use Listable;
    public $timestamps = false;

    protected $casts = [
        'is_nav' => 'boolean',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public static function allCategory()
    {
        $allMenu = Category::orderBy('parent_id', 'ASC')->ordered()->recent()->get()->toArray();
        $res = [];
        self::tree($allMenu, $res);
        return $res;
    }

    public static function getNav()
    {
        $allNav = Category::where('is_nav', true)->orderBy('parent_id', 'ASC')->ordered()->recent()->get()->toArray();
        $res = [];
        self::tree($allNav, $res);
        return $res;
    }

    private static function tree(&$allNav, &$res, $parent_id = 0)
    {
        foreach ($allNav as $key => $value) {
            if ($value['parent_id'] == $parent_id) {
                $res[$value['id']] = $value;
                $res[$value['id']]['children'] = [];
                unset($allNav[$key]);
                self::tree($allMenu, $res[$value['id']]['children'], $value['id']);
            }
        }
    }
}