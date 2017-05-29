<?php

namespace App\Http\Controllers;


use App\Models\Post;

class SearchController extends Controller
{
    public function search($keywords)
    {
        $keywords = strip_tags($keywords);
        $posts = Post::where('title', 'like', "%$keywords%")->orWhere('excerpt', 'like', "%$keywords%")
            ->post()
            ->publish()
            ->orderByTop()
            ->ordered()
            ->recent()
            ->paginate();
        return theme_view('post.search_list', [
            'keywords' => $keywords,
            'postList' => $posts
        ]);
    }
}