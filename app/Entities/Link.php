<?php

namespace App\Entities;


use App\Entities\Traits\Listable;
use Ty666\PictureManager\Traits\Picture;

class Link extends BaseModel
{
    use Picture, Listable;

    protected $fillable = ['name', 'url', 'logo', 'linkman', 'type_id', 'order', 'is_visible'];
    protected static $allowSortFields = ['name', 'type_id', 'order', 'is_visible'];
    protected static $allowSearchFields = ['name', 'url', 'linkman'];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function scopeIsVisible($query, $isVisible = true)
    {
        return $query->where('is_visible', $isVisible)->ordered();
    }

    public function scopeByType($query, $type)
    {
        if (is_null($type)) {
            return $query;
        }
        if ($type instanceof Type) {
            $typeId = $type->id;
        } elseif (is_array($type)) {
            $typeId = $type['id'];
        } else {
            $typeId = intval($type);
        }

        return $query->where('type_id', $typeId)->ordered()->recent();
    }

    public function getLogoUrlsAttribute()
    {
        //todo 找一个默认的logo
        return $this->getPicure($this->attributes['logo'], ['sm', 'md', 'lg', 'o'], asset('images/default_avatar.jpg'));
    }
}
