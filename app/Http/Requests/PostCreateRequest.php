<?php

namespace App\Http\Requests;


class PostCreateRequest extends Request
{
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
            'title' => 'required|uniqe:posts',
            'author_info' => 'nullable|string|max:50',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'cover' => 'nullable|picture',
            //'status' => 'nullable|in:publish,draft',
            'type' => 'in:post,page',
            'views_count' => 'nullable|int',
            'order' => 'nullable|int',
            'template' => 'nullable|string|max:30',
            'category_ids' => 'nullable|int_array',
        ];
    }
}
