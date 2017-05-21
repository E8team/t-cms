<?php

namespace App\Http\Requests;

class SettingCreateRequest extends Request
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
            'name' => 'required|max:30|unique:settings',
            'value' => 'nullable|string',
            'description' => 'nullable|string|max:255',
            'is_autoload' => 'nullable|boolean',
            'type_id' => 'nullable|int',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
