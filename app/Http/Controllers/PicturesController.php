<?php

namespace App\Http\Controllers;

use App\Entities\Category;
use Illuminate\Http\Request;
use PictureManager;
use Ty666\PictureManager\Exception\UploadException;

class PicturesController extends Controller
{
    public function show($img_id, $size, $suffix)
    {
        return PictureManager::init($img_id, $size, $suffix)->show();
    }

    public function upload(Request $request)
    {
        try{
            $picture = PictureManager::upload($request->file($request->get('picture_key', 'file')));
        }catch (UploadException $e){
            return $this->response->error('图片上传失败');
        }

        return ['picture' => $picture];
    }
}