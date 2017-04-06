<?php

namespace App\Entities;


use Ty666\PictureManager\Traits\Picture;

class Link extends BaseModel
{
    use Picture;
    public $timestamps = false;

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
        if($type instanceof Type)
        {
            $typeId = $type->id;
        }elseif(is_array($type)){
            $typeId = $type['id'];
        }else{
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
