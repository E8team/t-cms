<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\Update;

class TypeUpdateRequest extends Request
{
    use Update;

    protected $allowModifyFields = ['name', 'description', 'order'];

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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'nullable|string|max:30',
            'description' => 'nullable|string|max:255',
            'order' => 'nullable|int'
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
