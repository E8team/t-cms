<?php

namespace App\Transformers;

use App\Entities\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    public function transform(Category $category)
    {
        return [
            'id' => $category->id,
            'type' => $category->type,
            'image' => $category->image,
            'image_urls' => $category->image_urls,
            'parent_id' => $category->parent_id,
            'cate_name' => $category->cate_name,
            'description' => $category->description,
            'url' => $category->url,
            'cate_slug' => $category->cate_slug,
            'is_nav' => $category->is_nav,
            'order' => $category->order,
            'page_template' => $category->page_template,
            'list_template' => $category->list_template,
            'content_template' => $category->content_template,
            'setting' => $category->setting,
            'created_at' => $category->created_at->toDateTimeString(),
            'updated_at' => $category->updated_at->toDateTimeString()
        ];
    }
}
