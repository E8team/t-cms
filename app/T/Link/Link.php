<?php


namespace App\T\Link;

use App\Models\Type;
use App\Models\Link as LinkModel;

class Link
{
    public function getLink()
    {
        return Type::byModel('link')->with(['links' => function ($query){
            return $query->ordered()->ancient();
        }])->ordered()->get();
    }

    public function getLinkWithoutType()
    {
        return LinkModel::whereNull('type_id')->ordered()->ancient()->get();
    }

    public function getLinkFromCache()
    {
        return $this->getLink();
    }

    public function getLinkWithoutTypeFromCache()
    {
        return $this->getLinkWithoutType();
    }

    public function getLinkByTypeId($typeId)
    {
        return LinkModel::where('type_id', $typeId)->ordered()->ancient()->get();
    }

    public function getLinkByTypeIdFromCache($typeId)
    {
        return $this->getLinkByTypeId($typeId);
    }

}
