<?php

namespace App\Models;

use App\Models\Traits\Listable;
use App\Models\Traits\Typeable;
use Ty666\PictureManager\Traits\Picture;

class Banner extends BaseModel implements InterfaceTypeable
{
    use Typeable, Listable, Picture;
    protected $hasDefaultValuesFields = ['order', 'is_visible'];
    protected $fillable = ['url', 'title', 'picture', 'type_id', 'order', 'is_visible'];
    protected static $allowSortFields = ['type_id', 'order', 'is_visible'];
    protected static $allowSearchFields = ['title', 'url'];
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

}
