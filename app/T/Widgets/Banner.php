<?php
namespace App\T\Widgets;

use App\Models\Banner as BannerModel;
//todo need cache
class Banner extends BaseWidget
{
    protected $type = null;
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getData()
    {
        return ['banners' => BannerModel::byType($this->type)->ordered()->recent()->get()];
    }
}