<?php
/**
 * Created by PhpStorm.
 * User: ty
 * Date: 2017-03-19
 * Time: 16:29
 */

namespace App\Entities;


use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'desc');
    }
}