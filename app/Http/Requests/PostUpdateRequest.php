<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Rule;

class PostUpdateRequest extends FormRequest
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
        $postId = $this->route()->getParameter('postId');
        return [
            'title' => ['required', Rule::unique('posts')->ignore($postId)],
            'excerpt' => 'string',
            'content' => 'string',
            'cover' => 'string',
            'status' => 'in:publish,draft',
        ];
    }
}
