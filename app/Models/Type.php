<?php

namespace App\Models;

class Type extends BaseModel
{
    protected $hasDefaultValuesFields = ['order'];

    protected $fillable = ['name', 'description', 'order', 'class_name'];

    public $timestamps = false;

    public function scopeLink($query)
    {
        return $query->where('class_name', Link::class);
    }

    public function scopeBanner($query)
    {
        return $query->where('class_name', Banner::class);
    }

    public function links()
    {
        return $this->hasMany(Link::class);
    }
}
