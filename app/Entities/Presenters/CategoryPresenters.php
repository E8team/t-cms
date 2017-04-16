<?php

namespace App\Entities\Presenters;

use Laracasts\Presenter\Presenter;

class CategoryPresenters extends Presenter
{
    public function url()
    {
        if(!$this->entity->isExtLink()){
            return route('list', $this->cate_slug);
        }else{
            return $this->url;
        }
    }
}