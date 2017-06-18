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
            'image' => 'nullable|picture_id',
            'parent_id' => 'nullable|int',
            'cate_name' => 'required|string|max:30',
            'description' => 'nullable|string',
            'url' => 'nullable|url',
            'is_target_blank' => 'nullable|boolean',
            'cate_slug' => 'required|string|max:30|unique:categories',
            'is_nav' => 'nullable|boolean',
            'order' => 'nullable|int',
            'page_template' => 'nullable|string|max:30',
            'list_template' => 'nullable|string|max:30',
            'content_template' => 'nullable|string|max:30',
            'setting' => 'nullable|string'
        ];
    }
}
