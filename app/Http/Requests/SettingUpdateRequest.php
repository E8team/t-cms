<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\Update;
use Illuminate\Validation\Rule;


class SettingUpdateRequest extends Request
{

    use Update;

    protected $allowModifyFields = ['name', 'value', 'description', 'is_autoload'];

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
        $setting = $this->route()->parameter('setting');
        return [
            'name' => ['max:30', Rule::unique('settings')->ignore($setting->id)],
            'value' => 'nullable|string',
            'description' => 'nullable|string|max:255',
            'is_autoload' => 'nullable|boolean'
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
