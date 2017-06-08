<?php
namespace App\Http\Controllers\Admin\Api;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostContent;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Repositories\PostRepository;
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
     *
     * @param  Request $request
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
     *
     * @param  Post $post
     * @return \Dingo\Api\Http\Response
     */
    public function show(Post $post)
    {
        $cateids = $post->categories->pluck('id');
        return $this->response->item($post, new PostTransformer())
            ->addMeta('cate_ids', $cateids);
    }

    private function updatePage(Post $page, Request $request, PostRepository $postRepository)
    {
        // 更新单页
        $this->validate(
            $request, [
                'title' => 'nullable|max:100',
                'content' => 'nullable|required',
            ]
        );
        $data = $postRepository->filterData($request->only('title', 'content'));
        $page->addition($data);
        if(isset($data['title'])){
            $page->title = $data['title'];
            $page->save();
        }

    }

    public function storePage(Category $category, Request $request, PostRepository $postRepository)
    {
        if(!$category->isPage()){
            $this->response->errorNotFound('该栏目不是单网页');
        }
        $page = $category->page();
        if (is_null($page)) {
            // 创建单页
            $this->validate(
                $request, [
                    'title' => 'required|max:100',
                    'content' => 'required',
                ]
            );
            $data = $request->only('title', 'content');
            $data['category_ids'] = [$category->id];
            $data['published_at'] = Carbon::now();
            $data['user_id'] = Auth::id();
            $postRepository->createPage($data);
        } else {
            // 更新单页
            $this->updatePage($page, $request, $postRepository);
        }
        return $this->response->noContent();
    }

    /**
     * 创建文章
     *
     * @param PostCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request, PostRepository $postRepository)
    {
        $data = $request->all();
        //$data['status'] = 'publish';
        $data['user_id'] = Auth::id();
        $postRepository->createPost($data);
        return $this->response->noContent();
    }

    /**
     * 更新指定文章
     *
     * @param  Post              $post
     * @param  PostUpdateRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function update(Post $post, PostUpdateRequest $request)
    {
        $request->performUpdate($post);
        return $this->response->noContent();
    }

    /**
     * 软删除指定的文章
     *
     * @param  Post $post
     * @return \Dingo\Api\Http\Response
     */
    public function softDelete(Post $post)
    {
        $post->delete();
        return $this->response->noContent();
    }

    /**
     * 真删除
     * @param $postId
     * @return \Dingo\Api\Http\Response
     */
    public function destruct($postId)
    {
        Post::onlyTrashed()->findOrFail($postId)->forceDelete();
        return $this->response->noContent();
    }
    /**
     * 还原指定的被软删除的文章
     *
     * @param  $postId
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
     *
     * @param  Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function movePosts2Categories(Request $request, PostRepository $postRepository)
    {
        $this->validate(
            $request, [
            'post_ids' => 'int_array',
            'category_ids' => 'int_array',
            ]
        );
        $postIds = $request->get('post_ids');
        $categoryIds = $request->get('category_ids');
        $postRepository->movePosts2Categories($postIds, $categoryIds);
        return $this->response->noContent();
    }
}
