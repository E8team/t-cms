<?php
/**
 * 类别(例如友情链接的类别)
 */

namespace App\Http\Controllers\Admin\Api;


use App\Entities\Link;
use App\Entities\Type;
use App\Http\Requests\TypeCreateRequest;
use App\Http\Requests\TypeUpdateRequest;
use App\Transformers\TypeTransformer;

class TypesController extends ApiController
{

    /**
     * 友情链接的分类
     * @return \Dingo\Api\Http\Response
     */
    public function links()
    {
        $types = Type::link()->get();
        return $this->response->collection($types, new TypeTransformer());
    }

    public function store(TypeCreateRequest $request)
    {
        $data = $request->all();
        switch ($data['class_name']) {
            case 'link':
                $data['class_name'] = Link::class;
                break;
        }

        Type::create($request->all());
        return $this->response->noContent();
    }

    public function update(Type $type, TypeUpdateRequest $request)
    {
        $request->performUpdate($type);
        return $this->response->noContent();
    }
}