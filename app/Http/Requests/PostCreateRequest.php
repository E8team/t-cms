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
        return false;
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
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'cover' => 'nullable|picture',
            'status' => 'nullable|in:publish,draft',
            'type' => 'in:post,type',
            'order' => 'int'
        ];
    }
}
