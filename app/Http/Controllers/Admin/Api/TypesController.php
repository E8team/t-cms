<?php
/**
 * 类别(例如友情链接的类别)
 */

namespace App\Http\Controllers\Admin\Api;


use App\Entities\InterfaceTypeable;
use App\Entities\Link;
use App\Entities\Type;
use App\Http\Requests\TypeCreateRequest;
use App\Http\Requests\TypeUpdateRequest;
use App\Transformers\TypeTransformer;
use Illuminate\Http\Request;

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
        $data = filterNullWhenHasDefaultValue($request->all(), 'order');
        switch ($data['class_name']) {
            case 'link':
                $data['class_name'] = Link::class;
                break;
        }

        Type::create($data);
        return $this->response->noContent();
    }

    public function update(Type $type, TypeUpdateRequest $request)
    {
        $request->performUpdate($type);
        return $this->response->noContent();
    }

    public function destroy(Type $type, Request $request)
    {
        if(class_exists($type->class_name)){
            $model = app($type->class_name);
            if($model instanceof InterfaceTypeable)
            {
                if($request->has('delete_relation')){
                    // 需要删除关联数据
                    $model->byType($type)->delete();
                }else{
                    // 关联数据中的type_id 置为null
                    $model->byType($type)->update(['type_id', null]);
                }
            }
        }
        $type->delete();
        return $this->response->noContent();
    }
}