<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;


class PostUpdateRequest extends Request
{
    protected $allowModifyFields = ['title', 'excerpt', 'content', 'cover', 'status'];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
            'title' => ['required', Rule::unique('posts')->ignore($post->id)],
            'excerpt' => 'string',
            'content' => 'string',
            'cover' => 'string',
            'status' => 'in:publish,draft',
            'order' => 'int'
        ];
    }
}
