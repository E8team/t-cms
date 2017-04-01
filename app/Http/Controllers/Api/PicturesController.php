<?php
/**
 * Created by PhpStorm.
 * User: ty
 * Date: 2017-02-24
 * Time: 0:10
 */

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use PictureManager;
use Ty666\PictureManager\Exception\UploadException;

class PicturesController extends ApiController
{
    public function upload(Request $request)
    {

        $picture = '';
        try{
            $picture = PictureManager::upload($request->file($request->get('picture_key', 'file')));
        }catch (UploadException $e){
            return $this->response->error('图片上传失败');
        }

        return ['picture' => $picture];
    }

}