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
            'excerpt' => 'string',
            'content' => 'string',
            'cover' => 'string',
            'status' => 'in:publish,draft',
            'type' => 'in:post,type'
        ];
    }
}
