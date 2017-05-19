<?php

namespace App\T\Widgets;

use Facades\App\T\Navigation\Navigation;
class Navbar extends BaseWidget
{
    public function getData()
    {
        return [
            'navbars' => Navigation::getAllNavFromCache(),
            'topNav' => Navigation::getTopNav(),
        ];
    }
}