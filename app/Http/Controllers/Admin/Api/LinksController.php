<?php
/**
 * 友情链接
 */

namespace App\Http\Controllers\Admin\Api;


use App\Entities\Link;
use App\Entities\Type;
use App\Transformers\TypeTransformer;

class LinksController extends ApiController
{

    public function lists(Type $type)
    {
        dd(Link::byType($type)->get());
    }

    /**
     * 友情链接分类
     * @return \Dingo\Api\Http\Response
     */
    public function linkType()
    {
        $types = Type::linkType()->get();
        return $this->response->collection($types, new TypeTransformer());
    }
}