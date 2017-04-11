<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\Update;
use Illuminate\Validation\Rule;


class LinkUpdateRequest extends Request
{

    use Update;

    protected $allowModifyFields = ['url', 'logo', 'linkman', 'type_id', 'order', 'is_visible'];
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
            'url' => 'nullable|url|max:255',
            'logo' => 'nullable|picture_id',
            'linkman' => 'nullable|string|max:30',
            'type_id' => 'nullable|int',
            'order' => 'nullable|int',
            'is_visible' => 'nullable|boolean'
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
