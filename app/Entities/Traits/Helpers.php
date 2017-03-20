<?php
namespace App\Entities\Traits;

Trait Helpers
{
    public function scopePage4Api($query)
    {
        $request = request();
        $limitAndOffset = $request->only('limit', 'offset');
        array_walk($limitAndOffset, function (&$val) {
            $val = is_null($val) ? null : intval($val);
        });
        //todo 这里的20需要写活
        return $query->offset($limitAndOffset['offset'])->limit(is_null($limitAndOffset['limit']) ? 20 : $limitAndOffset['limit']);
    }
}