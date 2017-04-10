<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\Update;
use Illuminate\Validation\Rule;


class TypeCreateRequest extends Request
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
            'name' => 'required|string|max:30',
            'description' => 'nullable|string|max:255',
            'order' => 'nullable|int',
            // class_name指定Model类名 表示是该model的类别
            // 在store方法中给定真实的类名
            'class_name' => 'in:link'
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
