<?php

namespace App\Http\Requests;


class CategoryCreateRequest extends Request
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
            'type' => 'required|in:0,1,2',
            'image' => 'string|max:40',
            'parent_id' => 'int',
            'cate_name' => 'required|string|max:30',
            'description' => 'string',
            'url' => 'url',
            'cate_slug' => 'string|max:30|unqiue:categories',
            'is_nav' => 'boolean',
            'order' => 'int',
            'page_template' => 'string|max:30',
            'list_template' => 'string|max:30',
            'content_template' => 'string|max:30',
            'setting' => 'string'
        ];
    }
}
