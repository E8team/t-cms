<?php

namespace App\Http\Requests;


class LinkCreateRequest extends Request
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
            'url' => 'required|url|max:255',
            'name' => 'required|string|max:20',
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
