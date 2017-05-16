<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\Update;

class BannerUpdateRequest extends Request
{
    use Update;

    protected $allowModifyFields = ['url', 'title', 'picture', 'type_id', 'order', 'is_visible'];

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
            'title' => 'nullable|string|max:20',
            'url' => 'nullable|url|max:255',
            'picture' => 'nullable|picture_id',
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
