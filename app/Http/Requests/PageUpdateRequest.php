<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\Update;
use Illuminate\Validation\Rule;


class PageUpdateRequest extends Request
{
    use Update;
    protected $allowModifyFields = ['title', 'content', 'published_at'];

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
            'title' => ['nullable', Rule::unique('posts')->where(function ($query) {
                $query->where('type', 'page');
            })->ignore($post->id)],
            'content' => 'nullable|string',
            'category_ids' => 'nullable|int_array'
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
