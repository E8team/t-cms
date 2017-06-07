<?php

namespace App\Widgets;

use Facades\App\T\Navigation\Navigation;
class Navbar extends BaseWidget
{
    public function getData()
    {
        return [
            'navbars' => Navigation::getAllNav(),
            'topNav' => Navigation::getTopNav(),
        ];
    }
}