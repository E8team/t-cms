<?php
namespace App\Http\Controllers\Admin\Api;

use App\Entities\Post;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Transformers\PostTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use PictureManager;

class PostsController extends ApiController
{
    /**
     * 创建文章
     *
     * @param  PostCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
        $data = $request->all();
        $data['status'] = 'publish';
        // 处理置顶
        if($request->has('top')){
            $data['top'] = Carbon::now();
        }
        if($request->has('cover_in_content')){
            $data['conver'] = PictureManager::convert(public_path($request->get('cover_in_content')), 200, 300);
        }
        $post = Post::create($data);
        // 处理分类
        if(!empty($data['category_ids'])){
            $post->saveCategories($data['category_ids']);
        }

        return $this->response->noContent();
    }

    /**
     * 显示指定文章
     * @param Post $post
     * @return \Dingo\Api\Http\Response
     */
    public function show(Post $post)
    {
        return $this->response->item($post, new PostTransformer());
    }

    /**
     * 更新指定文章
     * @param Post $post
     * @param PostUpdateRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function update(Post $post, PostUpdateRequest $request)
    {

        // 处理置顶
        if($request->has('top')){
            $data['top'] = Carbon::now();
        }
        // 处理从正文中获取的封面
        if($request->has('cover_in_content')){
            $data['conver'] = PictureManager::convert(public_path($request->get('cover_in_content')), 200, 300);
        }
        $request->performUpdate($post);
        // 处理分类
        if(!empty($request->has('category_ids'))){
            $post->saveCategories($request->get('category_ids'));
        }

        return $this->response->noContent();
    }

    /**
     * 删除指定文章
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

    /**
     * 批量移动
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
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