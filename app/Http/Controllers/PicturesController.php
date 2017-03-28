<?php

namespace App\Http\Controllers;

use PictureManager;

class PicturesController extends Controller
{
    public function show($img_id, $size, $suffix)
    {
        return PictureManager::init($img_id, $size, $suffix)->show();
    }
}