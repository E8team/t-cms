<?php


namespace App\T\Link;

use App\Entities\Type;

class Link
{
    public function getLink()
    {
        return Type::link()->with('links')->get();
    }

    public function getLinkFromCache()
    {
        return $this->getLink();
    }
}