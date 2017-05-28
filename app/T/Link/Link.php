<?php


namespace App\T\Link;

use App\Models\Type;
use App\Models\Link as LinkModel;

class Link
{
    public function getLink()
    {
        return Type::byModel('link')->with(['links' => function ($query){
            return $query->ordered()->recent();
        }])->ordered()->get();
    }

    public function getLinkWithoutType()
    {
        return LinkModel::whereNull('type_id')->ordered()->recent()->get();
    }

    public function getLinkFromCache()
    {
        return $this->getLink();
    }

    public function getLinkWithoutTypeFromCache()
    {
        return $this->getLinkWithoutType();
    }
}
