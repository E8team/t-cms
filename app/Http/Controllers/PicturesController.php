<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ty666\PictureManager\Facades\PictureManager;

class PicturesController extends Controller
{
    public function show($pictureId, $size)
    {

        return app('pictureManager')->init($pictureId, $size)->show();
    }

    public function upload(Request $request)
    {
        $picture = app('pictureManager.uploader')->upload($request->file($request->get('picture_key', 'file')));
        return ['picture' => $picture];
    }
}