<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\Update;
use Illuminate\Validation\Rule;


class PermissionCreateRequest extends Request
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
            'name' => 'required:unique:permissions',
            'display_name' => 'string',
            'description' => 'string',
            'parent_id' => 'int',
            'is_menu' => 'boolean',
            'icon' => 'string',
            'order' => 'int'
        ];
    }
}
