<?php

namespace App\Entities;

use App\Entities\Traits\Listable;
use Ty666\PictureManager\Traits\Picture;

//todo need cache
class Category extends BaseModel
{
    use Listable, Picture;
    protected static $allowSearchFields = ['cate_name', 'description', 'url', 'cate_slug'];

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

    public static function allCategoryArray($type = null)
    {
        $allCategory = Category::byType($type)->orderBy('parent_id', 'ASC')->ordered()->recent()->get()->toArray();
        $res = [];
        self::tree($allCategory, $res);
        return $res;
    }

    private static function tree(&$allNav, &$res, $parent_id = 0)
    {
        $i = 0;
        foreach ($allNav as $key => $value) {
            if ($value['parent_id'] == $parent_id) {
                $res[$i] = $value;
                $res[$i]['children'] = [];
                unset($allNav[$key]);
                self::tree($allNav, $res[$i]['children'], $value['id']);
                $i++;
            }
        }
    }

    public function getImageUrlsAttribute()
    {
        //todo 找一个默认缩略图
        return $this->getPicure($this->image, ['sm', 'md', 'lg','o'], asset('images/default_avatar.jpg'));
    }

    public function scopeTopCategories($query)
    {
        return $query->where('parent_id', 0);
    }

    public function scopeChildrenCategories($query, $parentId)
    {
        return $query->where('parent_id', $parentId);
    }

    public function scopeByType($query, $type = null)
    {
        switch ($type)
        {
            case 'post':
                $query->where('type', 0);
                break;
            case 'page':
                $query->where('type', 1);
                break;
            case 'ext_link':
                $query->where('type', 2);
                break;
        }
        return $query;
    }

    /**
     * 获取该分类下的文章数量
     * @return mixed
     */
    public function getPostNum()
    {
        return $this->posts()->post()->count();
    }
}