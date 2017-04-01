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
            'image' => 'string|max:40',
            'parent_id' => 'int',
            'cate_name' => 'string|max:30',
            'description' => 'string',
            'url' => 'url',
            'cate_slug' => ['string', 'max:30', Rule::unique('category')->ignore($category->id)],
            'is_nav' => 'boolean',
            'order' => 'int',
            'page_template' => 'string|max:30',
            'list_template' => 'string|max:30',
            'content_template' => 'string|max:30',
            'setting' => 'string'
        ];
    }
}
