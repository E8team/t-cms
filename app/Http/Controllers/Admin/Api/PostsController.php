<?php
namespace App\Http\Controllers\Admin\Api;

use App\Entities\Post;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Transformers\PostTransformer;
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
}