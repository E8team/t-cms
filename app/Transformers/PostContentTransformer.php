<?php
/**
 * Created by PhpStorm.
 * User: ty
 * Date: 2017/4/5 0005
 * Time: 下午 8:59
 */

namespace App\Transformers;


use App\Entities\PostContent;
use League\Fractal\TransformerAbstract;

class PostContentTransformer extends TransformerAbstract
{
    public function transform(PostContent $postContents)
    {
        return [
            'post_id' => $postContents->post_id,
            'content' => $postContents->content,
            'created_at' => $postContents->created_at->toDateTimeString(),
            'updated_at' => $postContents->updated_at->toDateTimeString()
        ];
    }
}