<?php

namespace App\Http\Requests;

class RoleCreateRequest extends Request
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
            'name' => 'required:unique:roles',
            'display_name' => 'nullable|string',
            'description' => 'nullable|string',
            'order' => 'nullable|int',
            'permission_ids' => 'nullable|int_array'
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
