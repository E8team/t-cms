<?php
namespace App\Entities\Traits;

Trait ErpListable
{
    //protected $allowSortFields = [];
    public function scopeWithSort($query, $order = null)
    {
        $order = is_null($order) ? request('order', null) : $order;
        if (!empty($order)) {
            if (is_string($order)) {
                $order = explode(',', $order);
            }
            foreach ($order as $v) {
                if (is_string($v)) $v = explode('-', $v, 2);
                if(in_array($v[0], self::$allowSortFields)){
                    $query->orderBy($v[0], isset($v[1])?$v[1]:'asc');
                }
            }
        }
        return $query;
    }

    //protected $allowSearchFields = [];
    public function scopeWithSimpleSearch($query, $keywords = null)
    {
        $keywords = is_null($keywords) ? request('q', null) : $keywords;
        if (!empty($keywords) && !empty(self::$allowSearchFields)) {
            $query->where(function ($query) use ($keywords) {
                foreach (self::$allowSearchFields as $field) {
                    $query->orWhere($field, 'like', '%' . $keywords . '%');
                }
            });
        }
        return $query;
    }
}