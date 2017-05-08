<?php

namespace App\Http\Controllers\Admin\Api;


use App\Models\Banner;
use App\Transformers\BannerTransformer;

class BannerController extends ApiController
{
    public function show(Banner $banner)
    {
        return $this->response->item($banner, new BannerTransformer());
    }

    public function allBanners()
    {
        $banners = Banner::ordered()
            ->recent()
            ->withSimpleSearch()
            ->withSort()
            ->paginate();
        return $this->response->paginator($banners, new BannerTransformer())
            ->setMeta(Banner::getAllowSortFieldsMeta() + Banner::getAllowSearchFieldsMeta());
    }

    public function desctory(Banner $banner)
    {
        $banner->delete();
        return $this->response->noContent();
    }
}