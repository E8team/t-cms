<?php

namespace App\Models;

use App\Models\Presenters\CategoryPresenters;
use App\Models\Traits\Listable;
use Laracasts\Presenter\PresentableTrait;
use Ty666\PictureManager\Traits\Picture;

class Category extends BaseModel
{
    use Listable, Picture, PresentableTrait;

    protected $presenter = CategoryPresenters::class;

    protected static $allowSearchFields = ['cate_name', 'description', 'url', 'cate_slug'];
    protected $hasDefaultValuesFields = ['parent_id', 'order', 'is_nav', 'is_target_blank'];
    protected $casts = [
        'is_nav' => 'boolean',
    ];
    protected $fillable = ['type', 'image', 'parent_id', 'cate_name',
        'description', 'url', 'is_target_blank', 'cate_slug', 'is_nav', 'order',
        'page_template', 'list_template', 'content_template', 'setting'];


    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    /**
     * 文章列表
     * @param $query
     * @return mixed
     */
    public function postListWithOrder($order = null)
    {
        $query = $this->posts()->post()->publish()->orderByTop();
        switch ($order) {
            case 'default':
                $query->ordered()->recent();
                break;
            case 'recent':
                $query->recent()->ordered();
                break;
            case 'popular':
                $query->orderBy('views_count', 'desc')->recent();
                break;
            default:
                $query->ordered()->recent();
                break;
        }
        return $query;
    }

    public function page()
    {
        return $this->posts()->page()->first();
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->ordered()->ancient();
    }

    /**
     * 该分类是否为顶级分类
     * @return bool
     */
    public function isTopCategory()
    {
        return $this->parent_id == 0;
    }

    /**
     * 通过slug来查找分类
     * @param $slug
     * @return Category
     */
    public static function findBySlug($slug)
    {
        return static::where('cate_slug', $slug)->firstOrFail();
    }

    /*public static function allCategory()
    {
        $allMenu = Category::orderBy('parent_id', 'ASC')->ordered()->ancient()->get()->toArray();
        $res = [];
        self::treeByArray($allMenu, $res);
        return $res;
    }*/


    public static function allCategoryArray($type = null)
    {
        $allCategory = Category::byType($type)->orderBy('parent_id', 'ASC')->ordered()->ancient()->get()->toArray();
        $res = [];
        self::treeByArray($allCategory, $res);
        return $res;
    }

    public static function allCategoryIndent($type = null, $indentStr = '-')
    {
        if (is_null($indentStr)) {
            $indentStr = '-';
        }
        $allCategory = Category::byType($type)->orderBy('parent_id', 'ASC')->ordered()->ancient()->get()->toArray();
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

    public function scopeNav($query)
    {
        return $query->where('is_nav', true);
    }

    public function scopeTopCategories($query)
    {
        return $query->where('parent_id', 0);
    }

    public function scopeByType($query, $type = null)
    {
        switch ($type) {
            case 'post_list':
            case 'post': // 为了兼容
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

    /**
     * 判断是否为同一个分类
     * @param Category $category
     * @return bool
     */
    public function equals(Category $category)
    {
        return $this->id == $category->id;
    }

    /**
     * 判断当前栏目(分类)是否为外部链接
     * @return bool
     */
    public function isExtLink()
    {
        return $this->type == 2;
    }

    /**
     * 判断当前栏目(分类)是否为单网页
     * @return bool
     */
    public function isPage()
    {
        return $this->type == 1;
    }

    /**
     * 判断当前栏目(分类)是否为列表栏目
     * @return bool
     */
    public function isPostList()
    {
        return $this->type == 0;
    }

    public function getHotPosts($num, $exceptPost = null)
    {
        $posts = $this->posts()->post()->publish()->orderBy('views_count', 'desc')->recent()->limit($num)->get();
        if ($exceptPost != null) {
            if (is_numeric($exceptPost)) {
                return $posts->where('id', '!=', $exceptPost);
            } elseif ($exceptPost instanceof Post) {
                return $posts->where('id', '!=', $exceptPost->id);
            }
        }
        return $posts;
    }
}
