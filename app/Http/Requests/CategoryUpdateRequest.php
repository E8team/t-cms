<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\Update;
use Illuminate\Validation\Rule;


class CategoryUpdateRequest extends Request
{

    use Update;

    protected $allowModifyFields = ['type', 'image', 'parent_id', 'cate_name',
        'description', 'url', 'cate_slug', 'is_nav', 'order',
        'page_template', 'list_template', 'content_template', 'setting'];
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
        $category = $this->route()->parameter('category');
        return [
            'type' => 'in:0,1,2',
            'image' => 'nullable|picture_id',
            'parent_id' => 'nullable|int',
            'cate_name' => 'nullable|string|max:30',
            'description' => 'nullable|string',
            'url' => 'nullable|url',
            'cate_slug' => ['nullable', 'string', 'max:30', Rule::unique('category')->ignore($category->id)],
            'is_nav' => 'nullable|boolean',
            'order' => 'nullable|int',
            'page_template' => 'nullable|string|max:30',
            'list_template' => 'nullable|string|max:30',
            'content_template' => 'nullable|string|max:30',
            'setting' => 'nullable|string'
        ];
    }

    public function messages()
    {
        return [

        ];
    }

}
