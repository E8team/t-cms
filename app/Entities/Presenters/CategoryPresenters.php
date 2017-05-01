<?php

namespace App\Entities\Presenters;

use Laracasts\Presenter\Presenter;

class CategoryPresenters extends Presenter
{
    /**
     * a标签的属性
     */
    public function aProperty()
    {
        if (!$this->entity->isExtLink()) {
            return 'href="'.route('category', $this->cate_slug).'"';
        } else {
            return 'href="'.$this->url.'" target="_blank"';
        }
    }
}