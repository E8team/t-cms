<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use PictureManager;

class PostRepository
{
    public function movePosts2Categories($categoryIds, $postIds)
    {
        $categoryIds = Category::findOrFail($categoryIds)->pluck('id');
        $posts = Post::findOrFail($postIds);
        $posts->each(
            function ($post) use ($categoryIds) {
                $post->categories()->sync($categoryIds);
            }
        );
    }

    public function createPage($data)
    {
        $data = $this->filterData($data);
        $data['type'] = 'page';
        $post = Post::create($data);
        $post->addition(Arr::only($data, ['content', 'category_ids']));
        return $post;
    }

    public function filterData($data)
    {
        if (isset($data['title'])) {
            $data['title'] = e($data['title']);
        }
        if (isset($data['author_info'])) {
            $data['author_info'] = e($data['author_info']);
        }
        if (isset($data['excerpt'])) {
            $data['excerpt'] = e($data['excerpt']);
        }
        if (isset($data['content'])) {
            $data['content'] = clean($data['content']);
        }
        // 处理置顶
        if (isset($data['top'])) {
            if ($data['top']) {
                $data['top'] = Carbon::now();
            } else {
                $data['top'] = null;
            }
        }
        if (isset($data['cover_in_content'])) {
            $data['conver'] = PictureManager::convert($data['cover_in_content']);
        }
        if (isset($data['published_at'])) {
            $data['published_at'] = new Carbon($data['published_at']);
        }
        return $data;
    }

    public function createPost($data)
    {
        $data = $this->filterData($data);
        $data['type'] = 'post';
        if (!isset($data['published_at'])) {
            $data['published_at'] = Carbon::now();
        }
        $post = Post::create($data);
        $post->addition(Arr::only($data, ['content', 'category_ids']));
        return $post;
    }
}