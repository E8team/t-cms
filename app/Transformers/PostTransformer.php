<?php

namespace App\Transformers;

class PostTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
            'id' => $model->id,
            'author' => $model->author,
            'title' => $model->title,
            'content' => $model->content,
            'cover' => $model->cover,
            'status' => $model->status,
            'type' => $model->type,
            'views_count' => $model->views_count,
            'comments_num' => $model->comments_num,
            'top' => $model->top,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
