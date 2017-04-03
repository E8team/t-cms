<?php
namespace App\Http\Controllers\Admin\Api;

use App\Entities\Post;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Transformers\PostTransformer;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostsController extends ApiController
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  PostCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
        Post::create($request->all());
        return $this->response->noContent();
    }

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return $this->response->item($post, new PostTransformer());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PostUpdateRequest $request
     * @param  string $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post, PostUpdateRequest $request)
    {
        $request->performUpdate($post);
        return $this->response->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Post::destroy(intval($id))) {
            //todo 国际化
            throw new NotFoundHttpException('该文章不存在');
        }
        return $this->response->noContent();
    }

    public function movePosts2Categories(Request $request)
    {
        $this->validate($request, [
            'post_ids' => 'int_array',
            'category_ids' => 'int_array',
        ]);
        $postIds = $request->get('post_ids');
        $categoryIds = $request->get('category_ids');
        Post::movePosts2Categories($postIds, $categoryIds);
        return $this->response->noContent();
    }
}