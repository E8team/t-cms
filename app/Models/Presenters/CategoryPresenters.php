<?php

namespace App\Models\Presenters;

use Laracasts\Presenter\Presenter;

class CategoryPresenters extends Presenter
{
    /**
     * a标签的属性
     */

    public function aProperty($needTarget = false, $target = '_blank')
    {
        if (!$this->entity->isExtLink()) {
            $propertyStr = ' href="'.route('category', $this->cate_slug).'"';
            if($needTarget){
                $propertyStr.='target="'.$target.'"';
            }
            return $propertyStr;
        } else {
            return ' href="'.$this->url.'" target="_blank"';
        }
    }
}
