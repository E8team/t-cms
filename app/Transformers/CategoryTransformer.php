<?php

namespace App\Transformers;

class CategoryTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
            'type' => $model->type,
            'image' => $model->image,
            'image_urls' => $model->image_urls,
            'parent_id' => $model->parent_id,
            'cate_name' => $model->cate_name,
            'description' => $model->description,
            'url' => $model->url,
            'cate_slug' => $model->cate_slug,
            'is_nav' => $model->is_nav,
            'order' => $model->order,
            'page_template' => $model->page_template,
            'list_template' => $model->list_template,
            'content_template' => $model->content_template,
            'setting' => $model->setting
        ];
    }
}
