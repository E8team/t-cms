<?php

namespace App\Entities\Presenters;

use Laracasts\Presenter\Presenter;

class PostPresenters extends Presenter
{
    public function suitedTitle()
    {
        return str_limit($this->title, 88);
    }
}