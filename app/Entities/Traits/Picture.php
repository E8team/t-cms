<?php
namespace App\Entities\Traits;

use PictureManager;

Trait Picture
{
    public function getPicure($picture, $allowSizeList = null)
    {
        if(empty($picture)) return null;

        $sizeList = array_keys(config('picture.sizeList'));
        if(!is_null($allowSizeList))
        {
            if(is_string($allowSizeList)) $allowSizeList = [$allowSizeList];

            $sizeList = array_intersect($allowSizeList, $sizeList);
        }
        list($pictureId, $suffix) = explode('.', $picture, 2);
        $data = [];
        foreach ($sizeList as $size){
            $data[$size] = route('image', [
                'img_id' => $pictureId,
                'size' => $size,
                'suffix' => $suffix
            ]);
        }
        return $data;
    }
}