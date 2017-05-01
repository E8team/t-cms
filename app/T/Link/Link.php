<?php


namespace App\T\Link;

use App\Entities\Type;
use App\Entities\Link as LinkModel;

class Link
{

    public function getLink()
    {
        return Type::link()->with('links')->ordered()->recent()->get();
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