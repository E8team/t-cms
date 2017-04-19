<?php

namespace App\Http\Requests;


use Illuminate\Validation\Rule;

class PageCreateRequest extends Request
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
            'title' => ['required', Rule::unique('posts')->where(function ($query) {
                $query->where('type', 'page');
            })],
            'content' => 'nullable|string',
            'category_ids' => 'nullable|int_array'
        ];
    }


}
