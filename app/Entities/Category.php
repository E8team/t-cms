<?php

namespace App\Entities;

use App\Entities\Traits\Listable;
use Ty666\PictureManager\Traits\Picture;

//todo need cache
class Category extends BaseModel
{
    use Listable, Picture;
    public $timestamps = false;

    protected $casts = [
        'is_nav' => 'boolean',
    ];


    protected $fillable = ['type', 'image', 'parent_id', 'cate_name',
        'description', 'url', 'cate_slug', 'is_nav', 'order',
        'page_template', 'list_template', 'content_template', 'setting'];

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
                self::tree($allNav, $res[$value['id']]['children'], $value['id']);
            }
        }
    }

    public function getImageUrlsAttribute($image)
    {
        //todo 找一个默认缩略图
        return $this->getPicure($image, ['sm', 'md', 'lg','o'], asset('images/default_avatar.jpg'));
    }

    public function scopeTopCategories($query)
    {
        return $query->where('parent_id', 0);
    }

    public function scopeChildrenCategories($query, $parentId)
    {
        return $query->where('parent_id', $parentId);
    }
}