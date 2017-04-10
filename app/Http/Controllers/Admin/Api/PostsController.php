<?php
namespace App\Http\Controllers\Admin\Api;

use App\Entities\Post;
use App\Entities\PostContent;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Transformers\PostTransformer;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PictureManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        $data['user_id'] = Auth::id();
        Post::createPost($data);
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

        $data['type'] = 'post';
        // 处理置顶
        if (isset($data['top'])) {
            $data['top'] = Carbon::now();
        }
        // 处理从正文中获取的封面
        if (isset($data['cover_in_content'])) {
            $data['conver'] = PictureManager::convert(public_path($request->get('cover_in_content')), 200, 300);
        }
        $data['created_at'] = Carbon::createFromTimestamp(strtotime($data['created_at']));
        $request->performUpdate($post);
        if (isset($data['content'])) {
            $post->content()->save(new PostContent(['content' => $data['content']]));
        }
        // 处理分类
        if (!empty($data['category_ids'])) {
            $post->saveCategories($data['category_ids']);
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
            throw new NotFoundHttpException(trans('message.post_not_found'));
        }
        PostContent::destroy(intval($id));
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