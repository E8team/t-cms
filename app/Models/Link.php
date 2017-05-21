<?php

namespace App\Models;

use App\Models\Traits\Listable;
use App\Models\Traits\Typeable;
use Ty666\PictureManager\Traits\Picture;

class Link extends BaseModel implements InterfaceTypeable
{
    use Picture, Listable, Typeable;
    protected $hasDefaultValuesFields = ['order', 'is_visible'];
    protected $fillable = ['name', 'url', 'logo', 'linkman', 'type_id', 'order', 'is_visible'];
    protected static $allowSortFields = ['name', 'type_id', 'order', 'is_visible'];
    protected static $allowSearchFields = ['name', 'url', 'linkman'];
    protected $casts = [
        'is_visible' => 'boolean'
    ];


    public function scopeIsVisible($query, $isVisible = true)
    {
        return $query->where('is_visible', $isVisible)->ordered();
    }

    public function getLogoUrlsAttribute()
    {
        return $this->getPicure($this->attributes['logo'], ['sm', 'md', 'lg', 'o']);
    }

    public function getLogoUrl($style, $defaultPic = '')
    {
        return $this->getPicure($this->attributes['logo'], $style, $defaultPic);
    }
}
