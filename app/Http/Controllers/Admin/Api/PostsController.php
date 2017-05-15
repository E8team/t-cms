<?php
namespace App\Http\Controllers\Admin\Api;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostContent;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Transformers\PostTransformer;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostsController extends ApiController
{
    public function __construct()
    {
        $this->middleware('permission:admin.post.create')->only('store');
        $this->middleware('permission:admin.post.show')->except('store');
        $this->middleware('permission:admin.post.categories')->only('storePage');
    }
    /**
     * 全部文章
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function lists(Request $request)
    {
        $posts = Post::applyFilter($request)
            ->with('user')
            ->paginate($this->perPage());
        return $this->response->paginator($posts, new PostTransformer());
    }

    /**
     * 显示指定文章
     * @param Post $post
     * @return \Dingo\Api\Http\Response
     */
    public function show(Post $post)
    {
        $cateids = $post->categories->pluck('id');
        return $this->response->item($post, new PostTransformer())
            ->addMeta('cate_ids', $cateids);
    }

    public function storePage(Category $category, Request $request)
    {
        $data = array_filter($request->only('title', 'content'), function ($item) {
            return !is_null($item);
        });
        $data['category_ids'] = [$category->id];
        $page = $category->page();
        if (is_null($page)) {
            //todo 验证规则
            $this->validate($request, [
                'title' => 'required',
                'content' => 'required',
            ]);
            // 创建
            $data['published_at'] = Carbon::now();
            $data['user_id'] = Auth::id();
            Post::createPage($data);
        } else {
            $data = Post::filterData($data);
            $page->addition($data);
        }
        return $this->response->noContent();
    }

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
        //$data['status'] = 'publish';
        $data['user_id'] = Auth::id();
        Post::createPost($data);
        return $this->response->noContent();
    }

    /**
     * 更新指定文章
     * @param Post $post
     * @param PostUpdateRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function update(Post $post, PostUpdateRequest $request)
    {
        $request->performUpdate($post);
        return $this->response->noContent();
    }

    /**
     * 软删除指定的文章
     * @param Post $post
     * @return \Dingo\Api\Http\Response
     */
    public function softDelete(Post $post)
    {
        $post->delete();
        return $this->response->noContent();
    }

    /**
     * 还原指定的被软删除的文章
     * @param $postId
     * @return \Dingo\Api\Http\Response
     */
    public function restore($postId)
    {
        $post = Post::withTrashed()->where('id', $postId)->firstOrFail();
        $post->restore();
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
