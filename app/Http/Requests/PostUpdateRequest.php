<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\Update;
use App\Models\BaseModel;
use App\Models\Post;
use App\Repositories\PostRepository;

class PostUpdateRequest extends Request
{
    use Update{
        performUpdate as defaultPerformUpdate;
    }

    protected $allowModifyFields = [
        'title', 'author_info', 'excerpt', 'views_count', 'content', 'category_ids',
        'cover', 'status', 'template', 'top', 'published_at', 'cover_in_content'
    ];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['nullable', 'string', 'max:100' /*Rule::unique('posts')->where(function ($query) {
                $query->where('type', 'post');
            })->ignore($post->id)*/],
            'author_info' => 'nullable|string|max:50',
            'excerpt' => 'nullable|string',
            'cover' => 'nullable|picture_id',
            'status' => 'nullable|in:publish,draft',
            //'type' => 'nullable|in:post,page',
            'views_count' => 'nullable|int',
            'order' => 'nullable|int',
            //todo template 验证规则
            'template' => 'nullable|string|max:30',
            'category_ids' => 'nullable|int_array',
            'published_at' => 'nullable|date',
            'cover_in_content' => 'nullable|url'
        ];
    }

    public function performUpdate(BaseModel $post, callable $callback = null)
    {
        $this->defaultPerformUpdate(
            $post, function (array $data) use ($callback) {
                $data = app(PostRepository::class)->filterData($data);
                if(!is_null($callback)) {
                    $data = $callback($data);
                }
                return $data;
            }
        );
        $post->addition($this->only(['content', 'category_ids']));
    }
}
