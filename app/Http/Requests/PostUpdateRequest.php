<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\Update;
use Illuminate\Validation\Rule;


class PostUpdateRequest extends Request
{
    use Update;
    protected $allowModifyFields = ['title', 'author_info', 'excerpt', 'type', 'views_count', 'cover', 'status' , 'template', 'top', 'published_at'];

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
        $post = $this->route()->parameter('post');
        return [
            'title' => ['nullable', Rule::unique('posts')->ignore($post->id)],
            'author_info' => 'nullable|string|max:50',
            'excerpt' => 'nullable|string',
            'cover' => 'nullable|picture',
            'status' => 'nullable|in:publish,draft',
            //'type' => 'nullable|in:post,page',
            'views_count' => 'nullable|int',
            'order' => 'nullable|int',
            'template' => 'nullable|string|max:30',
            'category_ids' => 'nullable|int_array',
            'published_at' => 'nullable|date'
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
