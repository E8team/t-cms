<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\Update;
use Illuminate\Validation\Rule;


class PermissionUpdateRequest extends Request
{

    use Update;

    protected $allowModifyFields = ['name', 'display_name', 'description', 'parent_id', 'is_menu', 'icon', 'order'];
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
        $permission = $this->route()->parameter('permission');
        return [
            'name' => [Rule::unique('permissions')->ignore($permission->id)],
            'display_name' => 'nullable|string',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|int',
            'is_menu' => 'nullable|boolean',
            'icon' => 'nullable|string',
            'order' => 'nullable|int'
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
