<?php

namespace App\Transformers;

use App\Entities\Post;
use League\Fractal\TransformerAbstract;

class PostTransformer extends TransformerAbstract
{
    protected $availableIncludes  = ['content', 'categories'];
    public function transform(Post $post)
    {
        return [
            'id' => $post->id,
            'user' => $post->user,
            'categries' => $post->categries,
            'author_info' => $post->author_info,
            'title' => $post->title,
            'cover' => $post->cover,
            'status' => $post->status,
            'type' => $post->type,
            'views_count' => $post->views_count,
            'comments_num' => $post->comments_num,
            'top' => $post->top,
            'published_at' => $post->published_at->toDateTimeString(),
            'created_at' => $post->created_at->toDateTimeString(),
            'updated_at' => $post->updated_at->toDateTimeString()
        ];
    }

    public function includeContent(Post $post)
    {
        $content = $post->content;
        return $this->item($content, new PostContentTransformer());
    }

    public function includeCategories(Post $post)
    {

        $categories = $post->categories;
        return $this->collection($categories, new CategoryTransformer());
    }
}
