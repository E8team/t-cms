<?php

namespace App\Entities;


use App\Entities\Traits\Listable;
use App\Entities\Traits\Typeable;
use Ty666\PictureManager\Traits\Picture;

class Link extends BaseModel implements InterfaceTypeable
{
    use Picture, Listable, Typeable;

    protected $fillable = ['name', 'url', 'logo', 'linkman', 'type_id', 'order', 'is_visible'];
    protected static $allowSortFields = ['name', 'type_id', 'order', 'is_visible'];
    protected static $allowSearchFields = ['name', 'url', 'linkman'];
    protected $casts = [
        'is_visible' => 'boolean'
    ];
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function scopeIsVisible($query, $isVisible = true)
    {
        return $query->where('is_visible', $isVisible)->ordered();
    }

    public function getLogoUrlsAttribute()
    {
        //todo 找一个默认的logo
        return $this->getPicure($this->attributes['logo'], ['sm', 'md', 'lg', 'o'], asset('images/default_avatar.jpg'));
    }
}
