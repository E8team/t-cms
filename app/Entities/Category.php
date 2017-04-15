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

    public static function findBySlug($slug)
    {
        return static::where('cate_slug', $slug)->first();
    }

    public static function allCategory()
    {
        $allMenu = Category::orderBy('parent_id', 'ASC')->ordered()->recent()->get()->toArray();
        $res = [];
        self::treeByArray($allMenu, $res);
        return $res;
    }



    public static function allCategoryArray($type = null)
    {
        $allCategory = Category::byType($type)->orderBy('parent_id', 'ASC')->ordered()->recent()->get()->toArray();
        $res = [];
        self::treeByArray($allCategory, $res);
        return $res;
    }

    public static function allCategoryIndent($type = null, $indentStr = '-')
    {
        if (is_null($indentStr)) {
            $indentStr = '-';
        }
        $allCategory = Category::byType($type)->orderBy('parent_id', 'ASC')->ordered()->recent()->get()->toArray();
        $res = [];
        self::treeByIndent($allCategory, $res, $indentStr, 0, 0);
        return $res;
    }

    private static function treeByArray(&$allNav, &$res, $parentId = 0)
    {
        $i = 0;
        foreach ($allNav as $key => $value) {
            if ($value['parent_id'] == $parentId) {
                $res[$i] = $value;
                $res[$i]['children'] = [];
                unset($allNav[$key]);
                self::treeByArray($allNav, $res[$i]['children'], $value['id']);
                $i++;
            }
        }
    }

    private static function treeByIndent(&$allNav, &$res, $indentStr = '-', $parentId = 0, $level = 0)
    {
        foreach ($allNav as $key => $value) {
            if ($value['parent_id'] == $parentId) {
                $value['level'] = $level;
                $value['indent_str'] = str_repeat($indentStr, $level);
                $res[] = $value;
                self::treeByIndent($allNav, $res, $indentStr, $value['id'], $level + 1);
            }
        }
    }

    public function getImageUrlsAttribute()
    {
        //todo 找一个默认缩略图
        return $this->getPicure($this->image, ['sm', 'md', 'lg', 'o'], asset('images/default_avatar.jpg'));
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
        switch ($type) {
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