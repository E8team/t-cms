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
        static $link = null;
        if(is_null($link)){
            // todo cache
            $link = $this->getLink();
        }

        return $link;
    }

    public function getLinkWithoutTypeFromCache()
    {
        static $linkWithOutType = null;
        if(is_null($linkWithOutType)){
            // todo cache
            $linkWithOutType = $this->getLinkWithoutType();
        }
        return $linkWithOutType;
    }

    public function getLinkByTypeId($typeId)
    {
        return LinkModel::where('type_id', $typeId)->ordered()->ancient()->get();
    }

    public function getLinkByTypeIdFromCache($typeId)
    {
        static $linkByTypeId = [];
        if(!isset($linkByTypeId[$typeId])){
            //todo cache
            $linkByTypeId[$typeId] = $this->getLinkByTypeId($typeId);
        }
        return $linkByTypeId[$typeId];
    }

}
