<?php

namespace App\Entities;

class Category extends BaseModel
{
    public $timestamps = false;

    protected $casts = [
        'is_menu' => 'boolean',
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

    public static function getMenu()
    {
        $allMenu = Category::where('is_menu', true)->orderBy('parent_id', 'ASC')->ordered()->recent()->get()->toArray();
        $res = [];
        self::tree($allMenu, $res);
        return $res;
    }

    private static function tree(&$allMenu, &$res, $parent_id = 0 )
    {
        foreach ($allMenu as $key => $value){
            if($value['parent_id']==$parent_id){
                $res[$value['id']] = $value;
                $res[$value['id']]['children'] = [];
                unset($allMenu[$key]);
                self::tree($allMenu, $res[$value['id']]['children'], $value['id']);
            }
        }
    }
}