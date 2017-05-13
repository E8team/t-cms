<?php

namespace App\Transformers;

use App\Models\Post;
use League\Fractal\TransformerAbstract;

class PostTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['content', 'categories'];

    public function transform(Post $post)
    {
        return [
            'id' => $post->id,
            'user' => $post->user,
            'author_info' => $post->author_info,
            'title' => $post->title,
            'excerpt' => $post->excerpt,
            'cover' => $post->cover,
            'cover_urls' => $post->cover_urls,
            'status' => $post->status,
            'type' => $post->type,
            'views_count' => $post->views_count,
            'comments_num' => $post->comments_num,
            'template' => $post->template,
            'url' => $post->present()->getUrl(),
            'top' => !is_null($post->top),
            'top_time' => is_null($post->top)?null:$post->top->toDateTimeString(),
            'published_at' => $post->published_at->toDateTimeString(),
            'created_at' => $post->created_at->toDateTimeString(),
            'updated_at' => $post->updated_at->toDateTimeString()
        ];
    }

    public function includeContent(Post $post)
    {
        $content = $post->content;
        if (is_null($content)) {
            return $this->null();
        } else {
            return $this->item($content, new PostContentTransformer());
        }
    }

    public function includeCategories(Post $post)
    {
        $categories = $post->categories;
        return $this->collection($categories, new CategoryTransformer());
    }
}
